@extends('auth.user.app')

@section('page_title')
    Login
@endsection

@section('content')
<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row justify-content-center">
            
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">

                    @if(Session::has('status'))
                    <div class="alert alert-success col-lg-12" role="alert">
                      {{Session::get('status')}}
                    </div>

                    
                    @endif

                    @if(Session::has('errors'))
                    <div class="alert alert-danger col-lg-12" role="alert">
                      {{$errors->first()}}
                    </div>
                    @endif


                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" action={{route('password.update')}} method="POST"> 
                  @csrf
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>

                  <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Password Confirmation">
                  </div>
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="token" value="{{$token}}">
                  <input type="submit"  class="btn btn-primary btn-user btn-block" value="UPDATE">
                    
                  
                  <hr>
   
         
                </form>
                

      
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
@endsection