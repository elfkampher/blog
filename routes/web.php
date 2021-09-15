<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('about', 'PagesController@about')->name('pages.about');
Route::get('archive', 'PagesController@archive')->name('pages.archive');
Route::get('contact', 'PagesController@contact')->name('pages.contact');

Route::get('storage-link', function(){
    
    if(file_exists(public_path('storage'))){
        return 'The "public/storage" directory already exists';
    }

    app('files')->link(
        storage_path('app/public'), public_path('storage')
    );

   return 'The [public/storage] directory has been linked.';
});

Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');


Route::get('posts', function(){
    return App\Models\Post::all();
});

Auth::routes();

Route::group([    
    'prefix' => 'admin', 
    'namespace' => 'Admin', 
    'middleware' => 'auth'], 
function(){
    //Rutas de administración
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('users', 'UsersController', ['as' => 'admin']);

    Route::put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
    Route::put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');


    /*Route::get('posts', 'PostsController@index')->name('admin.posts.index');    
    Route::get('/posts/create', 'PostsController@create')->name('admin.posts.create');
    Route::post('/posts/store', 'PostsController@store')->name('admin.posts.store');    
    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    Route::post('/photos/deletephoto', 'PhotosController@deletephoto');
    Route::delete('/posts/{id}', 'PostsController@delete')->name('admin.posts.delete');*/

});



/*Route::get('register', function(){
    return redirect('/login');
});

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');