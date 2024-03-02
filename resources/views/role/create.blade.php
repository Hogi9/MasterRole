@extends('layout.main')
@section('content')
	<form action="{{ url('/hak-akses/role/store') }}" method="post">
		@csrf
		<div class="mb-3">
			<label class="form-label">Role Name</label>
			<input type="text" class="form-control @error('role-name') is-invalid @enderror" name="role-name"
				placeholder="Role Name..." value="{{ old('role-name') }}">
			@error('role-name')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
		<label class="form-label">Permission List</label>
		<div class="mb-3" style="max-height:500px; overflow:auto">
			<div class="row w-100">
				@foreach ($permissions as $permission)
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name ="role-permissions[]" value={{ $permission['name'] }}>
							<label class="form-check-label">
								{{ $permission['name'] }}
							</label>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<button class="btn btn-primary" type="submit">Tambah Role</button>
	</form>
@endsection
