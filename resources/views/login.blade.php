
@extends('loginlayout')
@section('title','Login')
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
        @if(Session::has('message'))
      <p class="alert alert-danger">{{session()->get('message')}}</p>
        @endif
      <form action="{{url('login')}}" method="post">
        @csrf()
        <div class="form-group">
            <select class="form-control" name="companydb" required>
              <option>Company</option>
              @foreach($companydb as $cd)
              <option value="{{$cd->CompIdent}}">{{$cd->CompIdent}}</li>
              @endforeach
            </select>
          </div>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="UserName" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@endsection
    