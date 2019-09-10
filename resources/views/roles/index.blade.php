@extends('layouts.app')


@section('title') Users @endsection('title')

@section('page_header')
Roles And permissions
@endsection

@section('content')

<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Roles And Permissions</h6>
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
            <button class="btn btn-md pl-4 mr-2 mb-4 pr-4 btn-success" data-toggle="modal"
                data-target="#createModal">Create Role</button>

                <button class="btn btn-md pl-4 mb-4 pr-4 btn-primary" data-toggle="modal"
                data-target="#createPermissionModal">Create permission</button>
        </div>

  

        <div class="table-responsive ">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>description</th>
                        <th>Perrmissions</th>
                        <th>action</th>

                    </tr>
                </thead>

                </tfoot>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->display_name}}</td>
                        <td>{{$role->description ?? "No Description"}}</td>
                        <td>@foreach($role->perms as $perm) {{$perm->display_name}} ,<br> @endforeach</td>
                        <td>
                            <ul class="d-flex col-md-12" style="list-style: none">
                                <li><a href="#" class="btn update btn-primary mr-3" data-model="role" data-id="{{$role->id}}"
                                        data-toggle="modal"
                                       data-fields ="name:{{$role->name}},
                                                             display_name:{{$role->display_name}},
                                                             description:{{$role->description}}"
                                           
                                       
                                       data-target="#UpdateModal"
                                        >Update</a></li>
                                <li><a href="" class="btn btn-danger delete" data-id="{{$role->id}}"  data-model="role" data-toggle="modal"
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
            <div class="modal-body">Are You Sure You Want To Delete This role</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" id="delete" action="{{route('role.destroy',['role'=>""])}}0">
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
          <h5 class="modal-title">Create New role</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

        <form class="col-md-12 role" id="create_form"  action = "{{route('role.store')}}" method="POST">

              @csrf

              <div class="form-group ">
                  <label>Name</label>
                  <input type="text" value="{{old('name')}}" name="name" class="form-control  form-control-role" placeholder="Name">
              </div>

              <div class="form-group ">
                <label>Select The Permissions</label>
                  <select name="permissions_id[]" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
                    
                    @foreach($permissions as $permission)

                    <option value="{{$permission->id}}" >{{$permission->name}}</option>
                    @endforeach
                      </select>
              
              </div>

              <div class="form-group ">
                    <label>Display Name</label>
                    <input class="form-control  form-control-role" type="text" name="display_name">
              </div>
              
              <div class="form-group ">
                    <label>Description</label>
                    <input  class="form-control  form-control-role" type="text" name="description">
              </div>

             

           


            
      
            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-role " form = "create_form" value="Create !"> 
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
                <h5 class="modal-title">Update role </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Choose Role Press Save To continue</div>
            <div class="modal-footer  col-md-12 ">
            <form class="col-md-12 role " id="update" method="POST" action="{{route('role.update',['role' => ""] )}}/">
                    @method('PUT')
                    @csrf

                    <div class="form-group ">
                            <label>Name</label>
                            <input type="text" value="{{old('name')}}" name="name" class="form-control  form-control-role" placeholder="Name">
                    </div>

                    <div class="form-group ">
                            <label>Display Name</label>
                            <input type="text" value="{{old('display_name')}}" name="display_name" class="form-control  form-control-role" placeholder="Name">
                    </div>

                    <div class="form-group ">
                            <label>Display Name</label>
                            <input type="text" value="{{old('description')}}" name="description" class="form-control  form-control-role" placeholder="Name">
                    </div>

                    <div class="form-group ">
                        
                          <select name="permissions_id[]" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
                            
                            @foreach($permissions as $permission)
        
                            <option value="{{$permission->id}}" >{{$permission->display_name}}</option>
                            @endforeach
                              </select>
                      
                      </div>

                    <input type="submit" class="btn btn-primary btn-role btn-block" value="save !">
                    <hr>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- end update modal-->

<!-- start create permission modal-->
 
<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create New Permission</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
    
            <form class="col-md-12 role" id="create_perrmission"  action = "{{route('permission')}}" method="POST">
    
                  @csrf
    
                  <div class="form-group ">
                      <label>Name</label>
                      <input type="text" value="{{old('name')}}" name="name" class="form-control  form-control-role" placeholder="Name">
                  </div>
        
                  <div class="form-group ">
                        <label>Display Name</label>
                        <input class="form-control  form-control-role" type="text" name="display_name">
                  </div>
                  
                  <div class="form-group ">
                        <label>Description</label>
                        <input  class="form-control  form-control-role" type="text" name="description">
                  </div>
              
          
                </form>
    
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary btn-role " form = "create_perrmission" value="Create !"> 
            </div>
          </div>
        </div>
     </div>
    <!-- end create permission modal -->


@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
<!-- Page level custom scripts -->
<script src="{{asset("js/demo/datatables-demo.js")}}"></script>
@endpush

