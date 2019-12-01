<div class="row">
    <div class="col-3 p-5">
        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
    </div>
    <div class="col-9 pt-5">
        <div class="d-flex justify-content-between align-items-baseline">
        <h1> {{ $user->username }} </h1>           
        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
            
        </div>
        @can('update', $user->profile)
            <a href="{{route('profile.edit',[$user->id])}}">Edit Profile</a>
        @endcan
        <div class="d-flex">
            <div class="pr-4"><strong >{{ $user->profile->followers->count() }}</strong> Followers</div>
            <div class="pr-4"><strong >1</strong> Following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{ $user->profile->title }} </div>
        <div>{{ $user->profile->description }} </div>
        <div><a href="#">{{ $user->profile->url }} </a></div>
    </div>
</div>

