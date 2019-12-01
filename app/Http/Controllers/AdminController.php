<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\User;
use App\OrganizerApply;
use App\ConsultantApply;
use App\Profile;
use DB;
use App\KnowledgeInvoice;
use App\Document;
use App\DocumentReport;
use App\Post;
use App\PostReport;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('admin.index');
    }
    
    public function userDetail()
    {
        $users = User::get();
        return view('admin.userDetail', compact('users'));
    }
    
    public function organizerDetail()
    {
        $users = User::where('organizer', true)->get();
        return view('admin.organizerDetail', compact('users'));
    }

    public function consultantDetail()
    {
        $users = User::where('consultant', true)->get();
        return view('admin.consultantDetail', compact('users'));
    }
    
    public function approveOrganizer(User $orgApply)
    {
        OrganizerApply::where('user_id', $orgApply->id)->update([
            'status' => '1'
        ]);

        User::where('id', $orgApply->id)->update([
            'organizer' => '1'
        ]);
        return redirect()->route('admin.showOrg', $orgApply);
    }

    public function organizerRequest()
    {
        $applyData = OrganizerApply::get();
        return view('admin.organizerRequest', compact('applyData'));
    }

    public function showOrg(User $orgApply)
    {
        $profile = Profile::where('user_id', $orgApply->id)->first();
        $orgApply = OrganizerApply::where('user_id', $orgApply->id)->first();
        return view('admin.showOrg', compact('orgApply', 'profile'));
    }
    
    public function consultantRequest()
    {
        $applyData = ConsultantApply::get();
        return view('admin.consultantRequest', compact('applyData'));
    }

    public function showCon(User $conApply)
    {
        $profile = Profile::where('user_id', $conApply->id)->first();
        $conApply = ConsultantApply::where('user_id', $conApply->id)->first();
        return view('admin.showCon', compact('conApply', 'profile'));
    }

    public function approveConsultant(User $conApply)
    {
        ConsultantApply::where('user_id', $conApply->id)->update([
            'status' => '1'
        ]);

        User::where('id', $conApply->id)->update([
            'consultant' => '1'
        ]);
        return redirect()->route('admin.showCon', $conApply);
    }
    public function banUser(User $user)
    {
        User::where('id', $user->id)->update([
            'status' => '0'
        ]);

        return redirect()->route('admin.userDetail');
    }
    
    public function reactiveUser(User $user)
    {
        User::where('id', $user->id)->update([
            'status' => '1'
        ]);

        return redirect()->route('admin.userDetail');
    }

    public function documentTransaction()
    {
        $transactions = DB::table('documents')
        ->join('knowledge_invoices', 'knowledge_invoices.document_id', '=', 'documents.id')
        ->join('users', 'users.id', '=', 'knowledge_invoices.buyer_id')
        ->get();
        return view('admin.documentTransaction', compact('transactions'));
    }

    public function courseTransaction()
    {
        $transactions = DB::table('courses')
        ->join('course_invoices', 'course_invoices.course_id', '=', 'courses.id')
        ->join('users', 'users.id', '=', 'course_invoices.buyer_id')
        ->get();
        return view('admin.courseTransaction', compact('transactions'));
    }
    
    public function questionTransaction()
    {
        $transactions = DB::table('questions')
        ->join('question_invoices', 'question_invoices.question_id', '=', 'questions.id')
        ->join('users', 'users.id', '=', 'question_invoices.buyer_id')
        ->get();
        return view('admin.courseTransaction', compact('transactions'));
    }

    public function reportDocument()
    {
        $reports = DB::table('document_reports')
        ->join('documents', 'documents.id', '=', 'document_reports.document_id')
        ->join('users', 'users.id', '=', 'document_reports.report_by')
        ->get();
        return view('admin.docReport', compact('reports'));
    }

    public function showReportDoc(Document $document)
    {
        $repDoc = Document::where('id', $document->id)->first();
        $profile = Profile::where('user_id', $repDoc->user_id)->first();
        return view('admin.showRepDoc', compact('repDoc', 'profile', 'document'));
    }
    
    public function adminDocDownload(Document $document)
    {
        $pathToFile = $document->document;
        
        return response()->download(storage_path('app/public/' . $pathToFile));
    }

    public function approveDocReport(Document $document)
    {
        Document::where('id', $document->id)->update([
            'documentStatus' => '0'
        ]);

        DocumentReport::where('document_id', $document->id)->update([
            'reportStatus' => '1'
        ]);
        return redirect()->route('admin.reportDocument');
    }

    public function reactiveDoc(Document $document)
    {
        Document::where('id', $document->id)->update([
            'documentStatus' => '1'
        ]);

        DocumentReport::where('document_id', $document->id)->update([
            'reportStatus' => '0'
        ]);
        return redirect()->route('admin.reportDocument');
    }

    public function reportPost()
    {
        $reports = DB::table('post_reports')
        ->join('posts', 'posts.id', '=', 'post_reports.post_id')
        ->join('users', 'users.id', '=', 'post_reports.report_by')
        ->get();
        return view('admin.postReport', compact('reports'));
    }

    public function approvePostReport(Post $post)
    {
        Post::where('id', $post->id)->update([
            'postStatus' => '0'
        ]);

        PostReport::where('post_id', $post->id)->update([
            'reportStatus' => '1'
        ]);
        return redirect()->route('admin.reportPost');
    }

    public function reactivePost(Post $post)
    {
        Post::where('id', $post->id)->update([
            'postStatus' => '1'
        ]);

        PostReport::where('post_id', $post->id)->update([
            'reportStatus' => '0'
        ]);
        return redirect()->route('admin.reportPost');
    }

    public function showReportPost(Post $post)
    {
        $repPost = Post::where('id', $post->id)->first();
        $profile = Profile::where('user_id', $repPost->user_id)->first();
        return view('admin.showRepPost', compact('repPost', 'profile', 'post'));
    }
}
