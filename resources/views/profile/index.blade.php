@extends('layout.main')
@section('content')
	<form action="{{ url('profile') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
				value="{{ old('email') ?? $user['email'] }}">
			@error('email')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
				value="{{ old('username') ?? $user['username'] }}">
			@error('username')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
		<div class="mb-3 form-password-toggle">
			<label for="password" class="form-label">Password</label>
			<div class="input-group input-group-merge">
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
					value="{{ old('password') }}" name="password"
					placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
				<span class="input-group-text cursor-pointer rounded-end">
					<i class="bx bx-hide"></i>
				</span>
				@error('password')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection
