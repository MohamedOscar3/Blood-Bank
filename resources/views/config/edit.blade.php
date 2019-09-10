@extends('layouts.app')

@section('title') Website Contact @endsection('title')

@section('page_header')
Contact Info
@endsection

@section('content')
@if(Session::has('errors'))
<div class="alert alert-danger" role="alert">
    {{$errors->first()}}
  </div>
@endif

@if(Session::has('msg'))
<div class="alert alert-success" role="alert">
    {{Session::get('msg')}}
  </div>
@endif


    
<form action="{{route('config.update',['post'=>1])}}" method="POST">
    @csrf
    @method('PUT')
   {{-- input phone number  --}}
    <div class="form-group" >
        <label>phone number</label>
        <input type="text" name="phone_number" class="form-control" value= "{{$config->phone_number}}">
    </div>
    {{-- input email --}}
        <div class="form-group" >
            <label>email</label>
            <input type="email" name="email" class="form-control" value="{{$config->email}}">
        </div>
    {{-- facebook  --}}
          <div class="form-group" >
            <label>facebook</label>
            <input type="text" name="fb"  class="form-control" value="{{$config->fb}}">
         </div>
    {{-- twitter --}}
         <div class="form-group" >
            <label>twitter</label>
            <input type="text" name="tw" class="form-control" value="{{$config->tw}}">
        </div>
    {{-- insta  --}}
         <div class="form-group" >
            <label>instegram</label>
            <input type="text" name="insta" class="form-control" value="{{$config->insta}}">
        </div>
    {{-- whats --}}
        <div class="form-group" >
            <label>whatsapp</label>
            <input type="text" name="whats" class="form-control" value="{{$config->whats}}">
        </div>
    {{-- youtube --}}
         <div class="form-group" >
            <label>Youtube</label>
            <input type="text" name="youtube" class="form-control" value='{{$config->youtube}}'>
        </div>
    {{-- gplus --}}
        <div class="form-group" >
            <label>google plus</label>
            <input type="text" name="gplus" class="form-control" value="{{$config->gplus}}">
        </div>
        <input type="submit" class="btn btn-primary" value="Update !"> 
</form>

@endsection