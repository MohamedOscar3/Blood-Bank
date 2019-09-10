@extends('layouts.app')


@section('title') cities @endsection('title')

@section('page_header')
cities
@endsection

@section('content')

<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>

    <div class="card-body ">
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


        <div class="row justify-content-end mr-1">
            <button class="btn btn-md pl-4 mb-4 pr-4 btn-success" data-toggle="modal"
                data-target="#createModal">Create</button>
        </div>

        <div class="table-responsive ">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>

                    </tr>
                </thead>

                </tfoot>
                <tbody>
                    @foreach ($cities as $city)
                    <tr>
                        <td>{{$city->id}}</td>
                        <td>{{$city->city_name}}</td>
                        <td>
                            <ul class="d-flex col-md-12" style="list-style: none">
                                <li><a href="#" class="btn update btn-primary mr-3"data-model="city"  data-id="{{$city->id}}"
                                        data-toggle="modal"
                                        data-fields="city_name:{{$city->city_name}},"
                                        
                                        
                                         data-target="#UpdateModal"
                                        >Update</a></li>

                                <li><a href="" class="btn btn-danger delete" data-model="city" data-id="{{$city->id}}"  data-toggle="modal"
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
            <div class="modal-body">Are You Sure You Want To Delete This city</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" id="delete" action="{{route('city.destroy',['city'=>""])}}0">
                    @method('delete')
                    @csrf
                <input type="submit" class="btn btn-danger"  value="Delete">
            </form>
            </div>
        </div>
    </div>
</div>

<!-- end delete modal-->


<!-- start create modal-->
 
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New city</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

        <form class="col-md-12 city" id="create_form"  action = "{{route('city.store')}}" method="POST">

              @csrf

              <div class="form-group ">
                  <label>City Name</label>
                  <input type="text" value="{{old('city_name')}}" name="city_name" class="form-control  form-control-city" placeholder="City Name">
              </div>


              <div class="form-group ">
                    <label>Governorate</label>
                    <select name="governorate_id" class="form-control">
                        @foreach($governorates as $governorate)
                    <option value="{{$governorate->id}}">{{$governorate->governorate_name}}</option>
                        @endforeach
                    </select>
                </div>






  
            
      
            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-city " form = "create_form" value="Create !"> 
        </div>
      </div>
    </div>
 </div>
<!-- end create modal -->




<!-- update modal-->

<div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update city</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Edit the city and then press save</div>
            <div class="modal-footer  col-md-12 ">
            <form class="col-md-12 city " id="update" method="POST" action="{{route('city.update',['city' => ""] )}}/">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>City Name</label>
                        <input type="text" class="form-control" name="city_name">
                    </div>

                    <div class="form-group ">
                            <label>Governorate</label>
                            <select name="governorate_id" class="form-control">
                                @foreach($governorates as $governorate)
                            <option value="{{$governorate->id}}">{{$governorate->governorate_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    <input type="submit" class="btn btn-primary btn-city btn-block" value="save !">
                    <hr>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- end update modal-->
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
