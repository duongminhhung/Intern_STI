
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">

        <div class="row no-gutters">

          <div class="col-md-5">
            <img src="https://stivietnam.com/wp-content/uploads/2022/12/sti-viet-nam-share.jpg" alt="login" class="login-card-img">
          </div>

          <div class="col-md-7">
            <div class="card-body">
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
<form>
        <div class="col-12">
          <div class="content_login">
            <h2>Đăng Nhập</h2>
            <h3>AGV Monitor</h3>
          </div>
            <div class="form-group">
                <label>Tên Đăng Nhập</label>
                <input type="text" wire:model="name_login" class="form-control" placeholder="Tên Đăng Nhập">
                @error('name_login') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Mật Khẩu :</label>
                <input type="password" wire:model="password_login" class="form-control" placeholder="Mật Khẩu">
                @error('password_login') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <!-- <input type="checkbox" class="form-control" name=""> <span class=""> ádfasf</span>  -->

        <div class="col-12 text-center">

            <button class="btn btn-block login-btn mb-4" wire:click.prevent="login">Đăng Nhập</button>
            Bạn chưa có tài khoản
            <a href="{{route('register')}}" class="btn btn-outline-dark text-reset" >Đăng ký tại đây</a>
        </div>
</form>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>