
<form >
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
        <div class="col-12">
            <div class="form-group">
                <label>Name :</label>
                <input type="text" wire:model="name" class="form-control" placeholder="Enter Name">
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Email :</label>
                <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Password :</label>
                <input type="password" wire:model="password" class="form-control" placeholder="Enter Password">
                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
		<div class="col-12">
            <div class="form-group">
                <label>Confirm Password :</label>
                <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Enter Password">
                @error('password_confirmation') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-12 text-center text-white">

            <button class="btn btn-block btn-success text-reset" wire:click.prevent="registerStore">Register</button>

        </div>

        <p class="login-card-footer-text mt-5">
           Do you already have an account
            <a class="btn btn-outline-dark text-reset" wire:click.prevent="register">Login</a>
        </p>
</form>