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
          
              <div class="col-lg-6 ">
                <div class="p-5">
                  <div class="text-center">
                      @if(Session::has('status'))
                      <div class="alert alert-success col-lg-12" role="alert">
                        {{Session::get('status')}}
                      </div>
                    
                      @endif
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  
                <form class="user" action="{{Route('password.email')}}" method="POST">
                  @csrf
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <input type="submit"  class="btn btn-primary btn-user btn-block" value=" Reset Password">
                    
                    
                  </form>
                  <hr>
      
                  <div class="text-center">
                  <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
@endsection