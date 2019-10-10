@extends('layouts.app')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">
	    	Form Tambah Buku
	    </li>
	  </ol>
	</nav>
	<div class="card card-body border-0">
		<form action="{{route('books.update', $book->id)}}" method="post">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="name">
					Judul Buku
				</label>
				<input type="text" name="name" class="form-control" value="{{$book->name}}" placeholder="Judul Buku.." required>
			</div>
			<div class="form-group">
				<label for="description">
					Deskripsi
				</label>
				<input type="text" name="description" class="form-control" value="{{$book->description}}" placeholder="Deskripsi...." required>
			</div>
			<div class="form-group">
				<label for="description">
					Penerbit
				</label>
				<input type="text" name="penerbit" class="form-control" value="{{$book->penerbit}}" placeholder="Penerbit..." required>
			</div>
			<div class="form-group">
				<label for="tanggal_terbit">
					Tanggal Terbit
				</label>
				<input type="date" name="tanggal_terbit" class="form-control" value="{{$book->tanggal_terbit}}" required>
			</div>
			<div class="form-group">
				<label for="stock">
					Jumlah Buku
				</label>
				<input type="number" name="stock" class="form-control" value="{{$book->stock}}" required>
			</div>

			<div class="mt-3 mb-3">
				<button type="submit" class="btn btn-info">
					Tambah Buku
				</button>
				<a href="" class="btn btn-light">
					Cancel
				</a>
			</div>
		</form>
	</div>
@endsection