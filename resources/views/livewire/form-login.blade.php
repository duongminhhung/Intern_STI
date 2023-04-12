
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login UI</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  

	
	
	<div class="form-container sign-in-container">
			<h1>Sign in</h1>
			
            
			<input type="text" wire:model="email" class="form-control">

			@error('email')
                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
            @enderror
			<input type="password" placeholder="Password" name="password" wire:mode="password" />
			@error('password')
                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
            @enderror
			<a>Sign In</button>
		</form>
	</div>
	
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>