@extends('layout.main')
@section('content')
	<div class="container-lg mt-4">
		<h3 class="text-start">View Role List</h3>
		@if (session('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		@if (session('fail'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				{{ session('fail') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<a class="btn btn-success float-end px-5" href="{{ url('/hak-akses/role/create') }}">+ Tambah</a>
		<div class="table-responsive-lg w-100">
			<table class="table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Role Name</th>
						<th class="text-nowrap" style="width:300px">Permission List</th>
						<th style="width:250px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($datas as $data)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $data['name'] }}</td>
							<td>
								<ul>
									@foreach ($data->permissions as $permission)
										<li class="text-nowrap">{{ $permission['name'] }}</li>
									@endforeach
								</ul>
							</td>
							<td>
								<a class="btn btn-warning mb-2" href="{{ url('/hak-akses/role/edit/' . $data['name']) }}" style="width:100px">
									Edit
								</a>
								<a class="btn btn-danger mb-2" href="{{ url('/hak-akses/role/delete/' . $data['name']) }}" style="width:100px">
									Delete
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
