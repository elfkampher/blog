<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id' 
    ];
    
    protected $dates = ['published_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post)
        {
            $post->tags()->detach();

            $post->photos->each->delete();        
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
        ->where('published_at','<=', Carbon::now())
        ->orderBy('published_at');
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this)){
            return $query;
        }else{
            return $query->where('user_id', auth()->id());
        }
    }


    public static function create(array $attributes = [])
    {
        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);

        if($this::where('url', $url)->exists())
        {
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;

        $this->save();
    }

    /*public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;

        $url = str_slug($title);

        $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->count();

        if($duplicateUrlCount>0)
        {
            $url .= "-" . ++$duplicateUrlCount;
        }

        $this->attributes['url'] = $url;
    }*/
    

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                                            ? $category
                                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        
        return $this->tags()->sync($tagIds);
    }

    public function isPublished()
    {
        /*$dt = Carbon::now()->toDateString();
        $postdate = Carbon::parse($this->published_at)->format('Y-m-d');
        
        if($dt > $postdate){
            return true;
        }*/
        return ! is_null($this->published_at) && $this->published_at < today();

    }
}
