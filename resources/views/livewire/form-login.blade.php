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
            <div class="form-group">
                <label>User Name :</label>
                <input type="text" wire:model="name_login" class="form-control">
                @error('name_login') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Password :</label>
                <input type="password" wire:model="password_login" class="form-control">
                @error('password_login') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12 text-center">

            <button class="btn btn-block login-btn mb-4" wire:click.prevent="login">Login</button>
        </div>


        <p class="login-card-footer-text">
            Don't have an account
            <a class="btn btn-outline-dark text-reset" wire:click.prevent="register">Register</a>
        </p>
</form>
