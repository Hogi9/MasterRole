@extends('layout.main')
@section('content')
	<div class="container-lg mt-4">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<h3 class="text-start">View Permission List</h3>
		<a class="btn btn-success float-end px-5" href="{{ route('permission.create') }}">+ Tambah</a>
		<div class="table w-100">
			<table class="table">
				<thead>
					<tr>
						<th style="width:30px">No.</th>
						<th>Permission List</th>
						<th class="text-center" style="width:200px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($datas as $data)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $data['name'] }}</td>
							<td class="text-center">
								<form action="{{ route('permission.destroy', ['permission' => $data['id']]) }}" method="POST"
									onsubmit="return confirm('Are you sure you want to delete this permission?')">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger mb-2" style="width:100px">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
