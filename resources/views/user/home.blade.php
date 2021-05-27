@extends('layouts.frontend')

@section('content')
 <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->            
            <div class="col-md-4 col-sm-6">
                <div class="card text-center" class="" style="width: 18rem;">
                  <img class="card-img-top" style="border-radius: 50%" width="100%" height="100%" src="{{ asset(Auth::user()->image) }}" alt="">
                  <ul class="list-group list-group-flush">
                   <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-block btn-primary">Home</a>
                    <a href="{{ route('image.update') }}" class="btn btn-sm btn-block btn-primary">Update Image</a>
                    <a href="{{ route('change.passwprd') }}" class="btn btn-sm btn-block btn-primary">Change Password</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-sm btn-block btn-danger">Sign Out</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </ul>
                </div>                
            </div>
        
                <div class="col-md-8 col-sm-6">
                  <h3 class="text-center"> <span class="text-dange">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your profile</h3>
                       <form method="POST" action="{{ route('edit-profile') }}">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Name <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="name" value="{{ auth::user()->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                         <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Email <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" value="{{ auth::user()->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                         <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Phone Number <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="phone" value="{{ auth::user()->phone }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                    </form>  
                    </div>  
                    <!-- create a new account -->         
                      </div><!-- /.row -->
                            </div><!-- /.sigin-in-->
                        </div>
                    </div>
                    @endsection