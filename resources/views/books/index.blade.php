@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
    	Data Buku
    </li>
  </ol>
</nav>

<div class="card card-body border-0">
	<div class="mt-3 mb-3">
		<a class="btn btn-info" href="{{route('books.create')}}">
			Tambah Stock Buku
		</a>
	</div>
	<table class="table table-striped">
		<tr>
			<th>Nama Buku</th>
			<th>Deskripsi</th>
			<th>Penerbit</th>
			<th>Tanggal Terbit</th>
			<th>Stock</th>
			<th>Action</th>
		</tr>
		@forelse($books as $book)
			<tr>
				<td>{{$book->name}}</td>
				<td>{{$book->description}}</td>
				<td>{{$book->penerbit}}</td>
				<td>{{$book->tanggal_terbit}}</td>
				<td>
					@if($book->stock <= 0)
						Stock buku habis
					@else
						{{$book->stock}}
					@endif
				</td>
				<td>
					<form type="hidden" method="post" action="{{route('books.destroy', $book->id)}}">
						@csrf
						@method('DELETE')
						<a href="{{route('books.edit', $book)}}" class="btn btn-warning btn-sm">Edit
						</a>
						<button type="submit" class="btn btn-danger btn-sm">
							Delete Buku
						</button>
					</form>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="6" class="text-center">
					Maaf stock buku belum tersedia
					Silahkan input stock buku
				</td>
			</tr>
		@endforelse
	</table>
</div>

@endsection