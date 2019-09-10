@extends('layouts.app')


@section('title')Posts @endsection('title')

@section('page_header')
Posts
@endsection

@section('content')

<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
    </div>

    <div class="card-body ">
        @if(Session::has('errors'))
        <div class="alert alert-danger" role="alert">
            {{$errors}}
          </div>
        @endif

        @if(Session::has('msg'))
        <div class="alert alert-success" role="alert">
            {{Session::get('msg')}}
          </div>
        @endif


        <div class="row justify-content-end mr-1">
        <a href="{{route('post.create')}}" class="btn btn-md pl-4 mb-4 pr-4 btn-success" 
                >Create</a>
        </div>

        <div class="table-responsive ">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>title</th>
                        <th>action</th>

                    </tr>
                </thead>

                </tfoot>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                    <td><a href="{{route('post.show',['post'=>$post->id])}}">{{$post->title}}</a></td>
                        <td>
                            <ul class="d-flex col-md-12" style="list-style: none">
                            <li><a href="{{route('post.edit',['post'=> $post->id])}}" class="btn btn-primary mr-3">
                                        Edit</a></li>
                                <li><a href="" class="btn btn-danger delete" data-model="post" data-id="{{$post->id}}" data-toggle="modal"
                                        data-target="#deleteModal">Delete</a></li>

                            </ul>
                        </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>

    </div>
</div>
</div>











<!-- delete modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warring !</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are You Sure You Want To Delete This post</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" id="delete" action="{{route('post.destroy',['post'=>""])}}">
                    @method('delete')
                    @csrf
                <input type="submit" class="btn btn-danger"  value="Delete">
            </form>
            </div>
        </div>
    </div>
</div>

<!-- end delete modal-->







@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
<!-- Page level custom scripts -->
<script src="{{asset("js/demo/datatables-demo.js")}}"></script>
@endpush

@push('style')
<link href="{{asset("vendor/datatables/dataTables.bootstrap4.min.css")}}" rel="stylesheet">
@endpush
