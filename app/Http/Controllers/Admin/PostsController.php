<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Carbon\Carbon;
use App\Http\Requests\StorePostRequest;


class PostsController extends Controller
{
    public function index(){

        $posts = Post::allowed()->get();

        return view('admin.posts.index')->with(compact('posts'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']);

        //$post = Post::create($request->only('title'));
        $post = Post::create([
            'title' => $request->get('title'),
            'user_id' => auth()->id()
        ]);

        $post->url = str_slug($request->title)."-{$post->id}";
        $post->save();        

        return redirect()->route('admin.posts.edit',compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit')->with(compact('categories'))->with(compact('tags'))->with(compact('post'));
        
    }

    public function update(Post $post, StorePostRequest $request)
    {
        $this->authorize('update', $post);
        
        $post->update($request->except('tags', 'files'));

        $post->syncTags($request->get('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy($id)
    {        

        $post = Post::find($id);        

        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('flash', 'La publicación ha sido eliminada');
    }
}
