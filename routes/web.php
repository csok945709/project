<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();

//Admin
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    //User
    Route::get('/userDetail', 'AdminController@userDetail')->name('admin.userDetail');
    Route::get('/banUser/{user}', 'AdminController@banUser')->name('admin.banUser');
    Route::get('/reactiveUser/{user}', 'AdminController@reactiveUser')->name('admin.reactiveUser');
    //Consultant
    Route::get('/consultantDetail', 'AdminController@consultantDetail')->name('admin.consultantDetail');
    Route::get('/consultantRequest', 'AdminController@consultantRequest')->name('admin.consultantRequest');
    Route::get('/consultantRequest/show/{conApply}', 'AdminController@showCon')->name('admin.showCon');
    Route::get('/approveConsultant/{conApply}', 'AdminController@approveConsultant')->name('admin.approveConsultant');
    //Organizer
    Route::get('/organizerDetail', 'AdminController@organizerDetail')->name('admin.organizerDetail');
    Route::get('/organizerRequest', 'AdminController@organizerRequest')->name('admin.organizerRequest');
    Route::get('/organizerRequest/show/{orgApply}', 'AdminController@showOrg')->name('admin.showOrg');
    Route::get('/approveOrganizer/{orgApply}', 'AdminController@approveOrganizer')->name('admin.approveOrganizer');
    //Document 
    Route::get('/documentTransaction', 'AdminController@documentTransaction')->name('admin.documentTransaction');
    Route::get('/reportDocument', 'AdminController@reportDocument')->name('admin.reportDocument');
    Route::get('/showReportDoc/{document}', 'AdminController@showReportDoc')->name('admin.showReportDoc');
    Route::get('/adminDocDownload/{document}', 'AdminController@adminDocDownload')->name('admin.adminDocDownload');
    Route::get('/approveDocReport/{document}', 'AdminController@approveDocReport')->name('admin.approveDocReport');
    Route::get('/reactiveDoc/{document}', 'AdminController@reactiveDoc')->name('admin.reactiveDoc');
    //Post
    Route::get('/reportPost', 'AdminController@reportPost')->name('admin.reportPost');
    Route::get('/approvePostReport/{post}', 'AdminController@approvePostReport')->name('admin.approvePostReport');
    Route::get('/reactivePost/{post}', 'AdminController@reactivePost')->name('admin.reactivePost');
    Route::get('/showReportPost/{post}', 'AdminController@showReportPost')->name('admin.showReportPost');
    //Online Course
    Route::get('/courseTransaction', 'AdminController@courseTransaction')->name('admin.courseTransaction');
    //Question
    Route::get('/questionTransaction', 'AdminController@questionTransaction')->name('admin.questionTransaction');
});



//Home Page
Route::get('/home/{user}', 'HomeController@index')->name('home.index');

//About Us
Route::get('/about', 'HomeController@about')->name('about');

//Knowledge Mine
Route::get('/knowledgeMine', 'KnowledgesController@index')->name('document.index');
Route::get('/d/create', 'KnowledgesController@create')->name('document.create');
Route::post('/d', 'KnowledgesController@store')->name('document.store');
Route::get('/d/{user}/{document}/delete', 'KnowledgesController@delete')->name('document.delete');
Route::get('/d/{user}/{document}/edit', 'KnowledgesController@edit')->name('document.edit');
Route::patch('/d/{user}/{documentID}', 'KnowledgesController@update')->name('document.update');
Route::get('/d/show/{user}/{document}', 'KnowledgesController@show')->name('document.show');
Route::get('/d/{user}/{document}/show/download', 'KnowledgesController@download')->name('document.download');
Route::post('/ratingDocument/{document}', 'KnowledgesController@documentStar')->name('documentStar');
Route::get('/d/report/{document}', 'KnowledgesController@report')->name('document.report');
Route::post('/reportStore/{document}', 'KnowledgesController@reportStore')->name('document.reportStore');


//Knowledge Comment 
Route::resource('/Knowledegecomments','KnowledgeCommentsController');
Route::resource('/d/{document}/Knowledegecomments','KnowledgeCommentsController');
Route::resource('/Knowledegecomments/replies','KnowledgeRepliesController');
//paypal
Route::get('payment/getrequest', 'PayPalController@getRequest')->name('payment.getRequest');
Route::get('payment/success', 'PayPalController@paymentSuccess')->name('payment.success');
Route::get('payment/{document}', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');



//profile
Route::get('/profile/course/{user}', 'ProfilesController@indexCourse')->name('profile.indexCourse');
Route::get('/profile/course/viewApply/{user}', 'ProfilesController@manageCourseApply')->name('profile.viewApply');
Route::get('/profile/course/viewApplicant/{user}', 'ProfilesController@viewApplicant')->name('profile.viewApplicant');
Route::get('/profile/course/viewOrgCourse/{user}', 'ProfilesController@manageCourseOraganized')->name('profile.viewOrgCourse');
Route::get('/profile/consultant/consultantTime/{user}', 'ProfilesController@consultantTime')->name('profile.consultantTime');
Route::get('/profile/consultant/bookAppointmentTime/{user}', 'ProfilesController@bookAppointmentTime')->name('profile.bookAppointmentTime');
Route::get('/profile/question/{user}', 'ProfilesController@indexQuestion')->name('profile.indexQuestion');
Route::get('/profile/document/{user}', 'ProfilesController@indexDocument')->name('profile.indexDocument');
Route::get('/profile/forum/{user}', 'ProfilesController@indexForum')->name('profile.indexForum');
Route::get('/profile/edit/{user}', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.index');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::get('/profile/reportDocDetails/{user}', 'ProfilesController@reportDocDetails')->name('profile.reportDocDetails');
Route::get('/profile/reportPostDetails/{user}', 'ProfilesController@reportPostDetails')->name('profile.reportPostDetails');






//Sharing Blog (Profile)
Route::post('/follow/{user}', 'FollowsController@store')->name('follow.store');
// Post
Route::get('/p/index', 'PostsController@index')->name('post.index');
Route::get('/p/indexFollow', 'PostsController@indexFollow')->name('post.indexFollow');
Route::get('/p/create', 'PostsController@create')->name('post.create');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');
Route::get('/p/{user}/{post}/edit', 'PostsController@edit')->name('post.edit');
Route::patch('/p/{user}/{post}', 'PostsController@update')->name('post.update');
Route::get('/p/{user}/{post}/show', 'PostsController@show')->name('post.show');
Route::get('/p/{user}/{post}/delete', 'PostsController@delete')->name('post.delete');
Route::post('/p', 'PostsController@store')->name('post.store');
Route::post('upload_image','CkeditorController@uploadImage')->name('upload');
Route::get('/p/report/{post}', 'PostsController@reportPost')->name('post.reportPost');
Route::post('/p/reportStore/{post}', 'PostsController@reportStore')->name('post.reportStore');
//Comment 
Route::resource('/comments','CommentsController');
Route::resource('/p/{post}/comments','CommentsController');
Route::resource('/replies','RepliesController');


//Online Course
Route::get('/onlinecourses', 'OnlineCourseController@index')->name('course.index');
Route::get('/onlinecourses/shop', 'OnlineCourseController@shop')->name('course.shop');
Route::get('/courseCat', 'OnlineCourseController@courseCat')->name('course.courseCat');
Route::get('/c/create', 'OnlineCourseController@create')->name('course.create');
Route::get('/c/{user}/{course}/register', 'OnlineCourseController@courseRegister')->name('course.register');
Route::get('/c/cancelRegister/{user}/{course}', 'OnlineCourseController@cancelRegister')->name('course.cancelRegister');
Route::get('/c/detail/{user}/{course}/', 'OnlineCourseController@detail')->name('course.detail');
Route::get('/c/{user}/{course}', 'OnlineCourseController@show')->name('course.show');
Route::post('/c', 'OnlineCourseController@store')->name('course.store');
Route::get('/c/{user}/{course}/edit', 'OnlineCourseController@edit')->name('course.edit');
Route::patch('/c/{user}/{course}', 'OnlineCourseController@update')->name('course.update');
Route::get('/c/{user}/{course}/delete', 'OnlineCourseController@delete')->name('course.delete');
Route::post('/ratingCourse/{course}', 'OnlineCourseController@courseStar')->name('courseStar');

//Online Course Comment 
Route::resource('/coursecomments','CourseCommentsController');
Route::resource('/coursecomments/replies','CourseRepliesController');
Route::resource('/c/{course}/coursecomments','CourseCommentsController');

//Online Course paypal
Route::get('course/payment/{course}', 'CoursePayPalController@payment')->name('coursePayment.payment');
Route::get('course/Makepayment/success', 'CoursePayPalController@paymentSuccess')->name('coursePayment.success');
Route::get('course/cancel', 'CoursePayPalController@cancel')->name('coursePayment.cancel');

//Organizer Apply 
Route::get('/c/apply', 'OrganizerApplyController@applyForm')->name('organizer.apply');
Route::post('/c/apply/store', 'OrganizerApplyController@store')->name('organizer.store');

//Consultant Apply 
Route::get('/consultant/apply', 'ConsultantApplyController@applyForm')->name('consultant.apply');
Route::post('/consultant/apply/store', 'ConsultantApplyController@store')->name('consultant.store');
//Consultant
Route::post('/consultant/addAppointmentTime/store', 'ConsultantAppointmentController@storeAppointmentTime')->name('consultant.storeAppointmentTime');
Route::get('/consultant/addAppointmentTime/{user}', 'ConsultantAppointmentController@addAppointmentTime')->name('consultant.addAppointmentTime');
Route::get('/consultant/editAppointmentTime/edit/{user}/{appointment}', 'ConsultantAppointmentController@editAppointmentTime')->name('consultant.editAppointmentTime');
Route::get('/consultant/cancelAppointmentTime/cancel/{user}/{appointment}/{consultant}', 'ConsultantAppointmentController@cancelAppointmentTime')->name('consultant.cancelAppointmentTime');
Route::patch('/consultant/updateAppointmentTime/update/{user}', 'ConsultantAppointmentController@updateAppointmentTime')->name('consultant.updateAppointmentTime');
Route::get('/consultant/manageAppointmentTime/{user}', 'ConsultantAppointmentController@manageAppointmentTime')->name('consultant.manageAppointmentTime');
Route::get('/consultant/editWorkingHour/{user}', 'ConsultantAppointmentController@editWorkingHour')->name('consultant.editWorkingHour');
Route::patch('/consultant/updateWorkingHour/update/{user}', 'ConsultantAppointmentController@updateWorkingHour')->name('consultant.updateWorkingHour');
Route::get('/consultant/viewAppointmentTime/{user}', 'ConsultantAppointmentController@viewAppointmentTime')->name('consultant.viewAppointmentTime');
Route::get('/consultant/bookingAppointment/{user}', 'ConsultantAppointmentController@bookingAppointment')->name('consultant.bookingAppointment');
Route::post('/consultant/bookingAppointment/store', 'ConsultantAppointmentController@storeBookingAppointment')->name('consultant.storeBookingAppointment');

Route::get('/consultant', 'ConsultantController@index')->name('consultant.index');
Route::get('/consultant/{user}', 'ConsultantController@show')->name('consultant.show');

//Chat
Route::get('/chat/{user}', 'ChatsController@index')->name('chat');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

//Bounty Question  paypal
Route::get('question/payment/success', 'QuestionPayPalController@paymentSuccess')->name('questionPayment.success');
Route::get('question/payment/{question}', 'QuestionPayPalController@payment')->name('questionPayment.payment');
Route::get('cancelPayment', 'QuestionPayPalController@cancelPayment')->name('questionPayment.cancelPayment');
// Bounty Question
Route::get('/q/index', 'BountyQuestionController@index')->name('question.index');
Route::get('/q/indexbounty', 'BountyQuestionController@indexFollow')->name('question.indexBounty');
Route::get('/q/create', 'BountyQuestionController@create')->name('question.create');
Route::get('/q/bounty/{user}/{question}', 'BountyQuestionController@show')->name('question.show');
Route::get('/q/rewardAnswer/{user}/{answer}/{question}', 'BountyQuestionController@rewardAnswer')->name('question.rewardAnswer');
Route::post('/q', 'BountyQuestionController@store')->name('question.store');
Route::get('/q/{user}/{question}/delete', 'BountyQuestionController@delete')->name('question.delete');
Route::get('/q/{user}/{question}/edit', 'BountyQuestionController@edit')->name('question.edit');
Route::patch('/q/{user}/{question}', 'BountyQuestionController@update')->name('question.update');
Route::get('/q/{user}/{question}', 'BountyQuestionController@show')->name('question.show');



//Bounty Question Answer
Route::resource('/questionAnswer','QuestionAnswerController');
Route::resource('/questionAnswer/replies','QuestionRepliesController');
Route::resource('/q/{question}/questionAnswer','QuestionAnswerController');
