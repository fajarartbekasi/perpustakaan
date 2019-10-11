@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
    	List Buku
    </li>
  </ol>
</nav>

@role('petugas')
<div class="card card-body border-0">
		<div class="mt-3 mb-3">
			<a class="btn btn-info" href="{{route('books.create')}}">
				Tambah Stock Buku
			</a>
		</div>
		<table class="table table-striped">
			<tr>
				<th>Nama Buku</th>
				<th>Penerbit</th>
				<th>Tanggal Terbit</th>
				<th>Stock</th>
				<th>Action</th>
			</tr>
			@forelse($books as $book)
				<tr>
					<td>{{$book->name}}</td>
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
@endrole
@role('anggota')
	<div class="row">
		@forelse($books as $book)
			<div class="col-md-4">
				<div class="card card-body border-0">
					<h6 class="font-weight-bold">{{$book->name}}</h6>
					<p class="text-muted">
						{{$book->description}}
					</p>

					<p> Total stock : {{$book->stock}}</p>

					<div class="mt-3 mb-3">
						<a href="{{route('borrowings.edit', $book->id)}}" class="btn btn-outline-info btn-block">
							Pinjam buku
						</a>
					</div>
				</div>
			</div>
			@empty
			<h1 class="text-center">Maaf List Buku belum tersedia</h1>
		@endforelse
	</div>
@endrole

@endsection