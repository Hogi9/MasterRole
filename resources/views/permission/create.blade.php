@extends('layout.main')
@section('content')
	<form action="{{ route('permission.store') }}" method="post">
		@csrf
		<div class="mb-3">
			<label class="form-label">Permission Name</label>
			<input type="text" class="form-control @error('permission-name') is-invalid @enderror" name="permission-name"
				placeholder="Permission Name..." value="{{ old('permission-name') }}">
			@error('permission-name')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
		<button class="btn btn-primary" type="submit">Tambah Permission</button>
	</form>
@endsection
