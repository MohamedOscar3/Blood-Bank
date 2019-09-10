@extends('layouts.app')


@section('title') Users @endsection('title')

@section('page_header')
Users
@endsection

@section('content')

<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
            <button class="btn btn-md pl-4 mb-4 pr-4 btn-success" data-toggle="modal"
                data-target="#createModal">Create</button>
        </div>

        <div class="table-responsive ">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>

                    </tr>
                </thead>

                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@foreach($user->roles as $role) {{$role->display_name}} ,<br> @endforeach</td>
                        <td>
                            <ul class="d-flex col-md-12" style="list-style: none">
                                <li><a href="#" class="btn update btn-primary mr-3"data-model="user"  data-id="{{$user->id}}"
                                        data-toggle="modal"
                                        data-user_role="2" data-target="#UpdateModal"
                                        >Update</a></li>
                                <li><a href="" class="btn btn-danger delete" data-model="user" data-id="{{$user->id}}" data-toggle="modal"
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
            <div class="modal-body">Are You Sure You Want To Delete This User</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" id="delete" action="{{route('user.destroy',['user'=>""])}}0">
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
          <h5 class="modal-title">Create New User</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

        <form class="col-md-12 user" id="create_form"  action = "{{route('user.store')}}" method="POST">

              @csrf

              <div class="form-group ">
                  <label>Name</label>
                  <input type="text" value="{{old('name')}}" name="name" class="form-control  form-control-user" placeholder="Name">
              </div>
              <div class="form-group ">
                <label>Select The Role</label>
                  <select name="role_id[]" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
                    
                    @foreach($roles as $role)

                    <option value="{{$role->id}}" >{{$role->display_name}}</option>
                    @endforeach
                      </select>
              
              </div>


              <div class="form-group">
                  <label>Email</label>
                <input type="email" value="{{old('email')}}" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
              </div>

              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Password</label>
                  <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Password Confirm</label>
                  <input type="password" name="password_confirmation" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                </div>
              </div>

            
      
            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-user " form = "create_form" value="Create !"> 
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
                <h5 class="modal-title">Update User Role</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Choose Role Press Save To continue</div>
            <div class="modal-footer  col-md-12 text-center">
            <form class="col-md-12 user " id="update" method="POST" action="{{route('user.update',['user' => ""] )}}/">
                    @method('PUT')
                    @csrf
        
                    <div class="form-group ">
                        
                          <select name="role_id[]" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
                            
                            @foreach($roles as $role)
        
                            <option value="{{$role->id}}" >{{$role->display_name}}</option>
                            @endforeach
                              </select>
                      
                      </div>

                    <input type="submit" class="btn btn-primary btn-user btn-block" value="save !">
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
