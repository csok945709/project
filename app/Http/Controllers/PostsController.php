<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\User;
use App\Like;
use App\Comment;
use App\Reply;

class PostsController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
}

        // $user = auth()->user()->following()->pluck('profiles.user_id');
        // $post = Post::whereIn('user_id', $user)->get();
        // dd($post);

      public function index()
    {
        $user = auth()->user()->pluck('id')->all(); 
        $posts = Post::whereIn('user_id', $user)->latest()->paginate(5);

        return view('posts.index',compact('posts'));
    }

    public function indexFollow()
    {
        $user = auth()->user()->following()->pluck('profiles.user_id'); 
        $postsFollow = Post::whereIn('user_id', $user)->latest()->paginate(5);
        return view('posts.indexFollow',compact('postsFollow'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show(User $user, Post $post)
    {

        // $comments = Comment::latest('created_at')->get();
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $comments =  Comment::where('post_id', $post->id)->latest('created_at')->get();
        $replies =  Reply::get();
        $viewer = Post::where('id', $post->id)->increment('visit_count');
        return view('posts.show',compact('user','post', 'follows','comments','replies'));
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'image' => ['required', 'image'],
            
        ]);
        
        $imagePath = request('image')->store('uploads','public');

        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'description' =>$data['description'],
            'image' => $imagePath,
        ]);
        
        return redirect('/profile/' . auth()->user()->id);
    }

    public function edit(User $user, Post $post)
    {
        return view('posts.edit',compact('user','post'));
    }

    public function delete(User $user, Post $post)
    {

        Post::where('user_id',$user->id)->where('id',$post->id)->delete();
        return redirect()->route('profile.index', compact('user'));
    }

    public function update(User $user, Post $post)
    {
    
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
            
        }
        Auth::user()->posts->find($post)->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // return view('profiles.profile',compact('user'));
        return redirect()->route('post.show', [$user,$post]);
    }

}
