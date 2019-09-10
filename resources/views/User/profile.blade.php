@extends('layouts.app')


@section('title') {{Auth::user()->name}} Profile @endsection('title')

@section('page_header')
 Welcome {{Auth::user()->name}}
@endsection


@section('content')
@if(Session::has('msg'))
<div class="alert alert-success">
        {{Session::get('msg')}}
</div>
@endif

@if(Session::has('errors'))
<div class="alert alert-danger">
        {{$errors->first()}}
</div>
@endif
<div class="row d-flex ">
    
        <div class="d-flex col-md-12 align-items-start">

                <div class="align-self-end col-md-4" id="profile_picture">
                <img src="{{Auth::user()->image[0]->url() ?? Storage::url('users/defult.png')}}  " alt="{{Auth::user()->name}} Profile Picture" class="img-thumbnail responsive" style="max-width: 25vw;max-height:25vw" >
                        <a id="upload_image"><i class="fas fa-camera"></i></a>  
                </div>

                <form id="upoload_photo_form" action="{{route('profile_update')}}" method="POST"   enctype="multipart/form-data">
                        <input id="profile_upload" type="file" name="profile_picture">
                        @csrf
                        
                </form>

                <div class="col-md-3">
                <form method="POST" action="{{route('user.update',['user'=>Auth::id()])}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                        <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                                </div>

                                <div class="form-group">
                                                <label for="email">email</label>
                                                <input type="email" name="email"  value="{{Auth::user()->email}}"class="form-control">
                                </div>
                                
                                <div class="form-group">
                                                <label for="password">password</label>
                                                <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                                <label for="password_confirmation">password confirmation</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Update !">

                        </form>

                </div>
        </div>

</div>

@endsection