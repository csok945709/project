<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\CourseInvoice;
use App\User;
use App\Document;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $user = User::findOrFail($user)->first();
        return view('profiles.blogIndex',compact('user', 'follows'));
    }


    public function indexDocument(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $user = User::findOrFail($user)->first();
        $documents = Document::where('user_id', $user)->latest()->paginate(5);
        return view('profiles.documentIndex',compact('user','documents','follows'));
    }

    public function indexCourse(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $user = User::findOrFail($user)->first();
        $courses = Document::where('user_id', $user)->latest()->paginate(5);
        return view('profiles.courseIndex',compact('user','courses','follows'));
    }

    public function manageCourseApply(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $user = User::findOrFail($user)->first();
        $courses = Document::where('user_id', $user)->latest()->paginate(5);
        $applyData = CourseInvoice::all();
       
        return view('profiles.course.viewApply',compact('user','courses','follows','applyData'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // return view('profiles.profile',compact('user'));
        return redirect("/profile/{$user->id}");
    }
    


}
