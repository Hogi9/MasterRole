@extends('layout.main')
@section('content')
	<div class="container-lg mt-4">
		<h3 class="text-start">View Permission List</h3>
		<button class="btn btn-success float-end px-5">+ Tambah</button>
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
								<button class="btn btn-danger mb-2" href="javascript:void(0);" style="width:100px"> Delete </button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
