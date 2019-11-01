<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Document;
use App\KnowledgeInvoice;
use App\KnowledgeComment;
use App\KnowledgeReply;

class KnowledgesController extends Controller
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
    public function index()
    {
        // $documents = DB::table('documents')->get();
        $documents = Document::paginate(5);
        return view('knowledge/index', compact('documents'));
    }

    public function create()
    {
        return view('knowledge.create');
    }


    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'document' => ['required', 'mimes:doc,pdf,docx,zip'],
        ]);
        
        $documentPath = request('document')->store('document','public');
        $price = request('price', 0);
        
        auth()->user()->documents()->create([
            'caption' => $data['caption'],
            'description' =>$data['description'],
            'document' => $documentPath,
            'price' => $price,
        ]);
        
        return redirect('/profile/' . auth()->user()->id . '/document');
    }


    public function show(User $user, Document $document)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $comments =  KnowledgeComment::latest('created_at')->get();
        $replies =  KnowledgeReply::where('knowledgecomment_id', $document->id)->get();
        $docCount = KnowledgeInvoice::where('document_id', $document->id)->where('buyer_id', $user->id)->count();
        $payerId = KnowledgeInvoice::where('document_id', $document->id)->first('buyer_id');
        $docIdCheck =  KnowledgeInvoice::where('document_id', $document->id)->first('document_id',);
        return view('knowledge.show',compact('user','document', 'follows', 'comments', 'replies','payerId','docIdCheck', 'docCount'));
    }

    public function download(User $user, Document $document)
    {
        $pathToFile = $document->document;
        
        return response()->download(storage_path('app/public/' . $pathToFile));
    }

    


   
    
    public function edit(User $user, Document $document)
    {
        return view('knowledge.edit',compact('user','document'));
    }

    public function delete(User $user, Document $document)
    {

        Document::where('user_id',$user->id)->where('id',$document->id)->delete();
        return redirect()->route('profile.indexDocument', compact('user'));
    }

    public function update(User $user, Document $document)
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
        Auth::user()->documents->find($document)->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // return view('profiles.profile',compact('user'));
        return redirect()->route('document.show', [$user,$document]);
    }
}
