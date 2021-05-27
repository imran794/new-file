@extends('layouts.dashboard')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile Update</li>
    </ol>
  </nav>
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
         <div class="card text-center" class="" style="width: 18rem;">
                  <img class="card-img-top" style="border-radius: 50%; margin-top: 10px;" width="100%" height="100%" src="{{ asset(Auth::user()->image) }}" alt="">
                  <ul class="list-group list-group-flush">
                   <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-block btn-primary">Home</a>
                    <a href="{{ route('admin.image.update') }}" class="btn btn-sm btn-block btn-primary">Update Image</a>
                    <a href="{{ route('admin.change.passwprd') }}" class="btn btn-sm btn-block btn-primary">Change Password</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-sm btn-block btn-danger">Sign Out</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </ul>
                </div>  

        </div>
        <div class="col-md-8">
         <div class="card">
               <h3 class="text-center"> <span class="text-dange">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your profile</h3>
             <div class="card-body">
                <form method="POST" action="{{ route('update.Data') }}">
                  @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth::user()->name }}">
                      @error('name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="text" class="form-control" name="email" id="exampleInputPassword1" value="{{ auth::user()->email }}">
                      @error('email')
                      <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                       <div class="form-group">
                      <label for="exampleInputPassword1">Phone Number</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputPassword1" value="{{ auth::user()->phone }}">
                      @error('phone')
                      <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Update Profile</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>

@endsection