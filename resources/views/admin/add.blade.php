@extends('layouts.app')
@section('title', 'Insert')
@section('content')







<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">

        <div class="row no-gutters">

      
            <div class="card-body" >
            <div>
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <form action="{{route('admin.insert')}}" method="post">
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="content_login">
        <h2>Thêm người dùng</h2>
        <h3>AGV Monitor</h3>
      </div>
        <div class="col-12">
            @csrf
            <div class="form-group">
                <label>Tên Đăng nhập :</label>
                <input type="text" name="name" class="form-control" placeholder="Tên Đăng Nhập">
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập Email">
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Mật khẩu :</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
            </div>
        </div>
		<div class="col-12">
            <h5>Xét những quyền cho người dùng</h5>
            <input type="checkbox" id="add" name="add" value="1">
            <label for="add"> Quyền thêm</label><br>
            <input type="checkbox" id="read" name="read" value="2">
            <label for="read">Quyền xem</label><br>
            <input type="checkbox" id="update" name="update" value="3">
            <label for="update">Quyền sửa</label><br>
            <input type="checkbox" id="delete" name="delete" value="4">
            <label for="delete">Quyền xóa</label><br>
        </div>
        <div class="col-12 text-center">

            <button class="btn btn-block login-btn mb-4" wire:click.prevent="registerStore">Thêm</button>
          
        </div>

    </form>


            </div>
          </div>

        </div>
      </div>

    </div>
  </main>

@endsection()
