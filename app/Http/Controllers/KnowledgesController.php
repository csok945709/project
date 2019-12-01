<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use App\DocumentReport;
use App\User;
use App\Document;
use App\KnowledgeInvoice;
use App\KnowledgeComment;
use App\KnowledgeReply;
use App\Rating;
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
        $documents = Document::where('documentStatus', true)->paginate(5);
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
            'document' => ['required', 'mimes:doc,pdf,docx,zip,ppt,pptx'],
        ]);
        $documentPath = request('document')->store('document','public');
        $price = request('price', 0);
        
        auth()->user()->documents()->create([
            'caption' => $data['caption'],
            'description' =>$data['description'],
            'document' => $documentPath,
            'price' => $price,
        ]);
        
        return redirect()->route('profile.indexDocument', [Auth::user()->id]);
    }


    public function show(User $user, Document $document)
    {
        $documentID = Document::where('id', $document->id)->first();
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $comments =  KnowledgeComment::latest('created_at')->get();
        $replies =  KnowledgeReply::get();
        $docCount = KnowledgeInvoice::where('document_id', $document->id)->where('buyer_id', $user->id)->count();
        $payerId = KnowledgeInvoice::where('document_id', $document->id)->first('buyer_id');
        $docIdCheck =  KnowledgeInvoice::where('document_id', $document->id)->first('document_id',);
        $documentRating = Document::where('id', $document->id)->first();
        $aver = $documentID->averageRating(User::class);  
        $ratingCount = Rating::where('rateable_type', 'App\Document')->where('rateable_id', $document->id)->count();
        $ratingAve = number_format($aver, 2);
       

        return view('knowledge.show',compact('user','document', 'follows', 'comments', 'replies','payerId','docIdCheck', 'docCount','documentRating', 'ratingAve', 'ratingCount'));
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

    public function update(User $user, Document $documentID)
    {
    
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'document' => '',
        ]);

        if (request('document')) {
            $documentPath = request('document')->store('document','public');
            $documentFile = Document::make(public_path("/storage/{$documentPath}"));
            $documentArray = ['document' => $documentPath];
        }
        auth()->user()->documents()->update(array_merge(
            $data,
            $documentArray ?? []
        ));

        // return view('profiles.profile',compact('user'));
        return redirect()->route('document.show', [$user,$documentID]);
    }

    public function documentStar (Request $request, Document $document) {
        $document = Document::where('id', $document->id)->first();
        $rating = new Rating;
        $rating->user_id = Auth::id();
        $rating->rating = $request->input('star');
        $document->ratings()->save($rating);
        return redirect()->back();
  }
  
  public function report(Document $document)
  {
     $document = Document::where('id', $document->id)->first();
     return view('knowledge.report',compact('document'));
  }

  public function reportStore(Document $document)
    {
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
        ]);
        
        auth()->user()->docReport()->create([
            'reportType' => $data['caption'],
            'reportDescription' =>$data['description'],
            'document_id' => $document->id,
            'report_by' => Auth::user()->id,
        ]);
        
        return redirect()->route('profile.reportDocDetails', [Auth::user()->id]);
    }
}
