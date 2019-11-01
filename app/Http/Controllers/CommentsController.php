<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request, Post $post)
    {
        if (Auth::check()) {
          
            Comment::create([
                'name' => Auth::user()->username,
                'comment' => $request->input('comment'),
                'post_id' => $post->id,
                'user_id' => Auth::user()->id
               
            ]);
            $post = $post->id;
            $user = auth()->user()->id;
            return redirect()->route('post.show', compact('post','user'))->with('success','Comment Added successfully..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }


        
    }

    public function destroy(Comment $comment)
    {
        if (Auth::check()) {
            $replyData = Reply::where('comment_id', '=', $comment->id)->get('comment_id');
            $commentID = $comment->id;
            $commentUser = $comment->user_id;
            if ( $commentUser === Auth::user()->id) {
                if ($replyData === $commentID  && $commentID !== 0) {
                    DB::table('comments')->where('user_id', '=', Auth::user()->id)->where('id', '=', $commentID)->delete();
                    return 1;
                }else if($commentID !== 0){
                    $comment->delete();
                    return 2;
                }else{
                    return 3;
                }
            }else {
                return 3;
            }

        }    
    }
}

