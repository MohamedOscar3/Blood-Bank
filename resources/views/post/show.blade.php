@extends('layouts.app')

@section('title') {{$post->title}} @endsection('title')

@section('page_header')
{{$post->title}}
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

<div class="article" >
    {!! $post->content !!}
</div>

@endsection