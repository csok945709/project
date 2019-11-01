<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use App\Document;
use App\KnowledgeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KnowledgeCommentsController extends Controller
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
    public function store(Request $request, Document $document)
    {
        if (Auth::check()) {
          
            KnowledgeComment::create([
                'name' => Auth::user()->username,
                'comment' => $request->input('comment'),
                'document_id' => $document->id,
                'user_id' => Auth::user()->id
               
            ]);
            $document = $document->id;
            $user = auth()->user()->id;
            return redirect()->route('document.show', compact('document','user'))->with('success','Comment Added successfully..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }


        
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $commentRequestID = (int)$request->id;
            $commentUserQuery = KnowledgeComment::where('id', '=', $commentRequestID)->first();
            $commentUser = $commentUserQuery->user_id;
            
            $commentID = $commentUserQuery->id;
            if ( $commentUser === Auth::user()->id) {
                if ($commentID === $commentRequestID) {
                    KnowledgeComment::where('user_id', '=', Auth::user()->id)->where('id', '=', $commentRequestID)->delete();
                    return 1;
                }else{
                    return 2;
                }
            }else {
                return 3;
            }

        }    
    }
}

