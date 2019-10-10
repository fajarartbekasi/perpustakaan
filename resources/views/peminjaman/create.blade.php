@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Form peminjaman buku
        </li>
    </ol>
</nav>
<div class="card card-body border-0">
    <form action="{{route('borrowings.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name_book">
                Buku
            </label>
            <select name="books" id="name_book" class="form-control">
                @foreach ($books as $book)
                    <option value="">Pilih buku</option>
                    <option value="{{$book->id}}">{{$book->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tgl_pinjam">Tanggal Peminjaman</label>
            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control">
        </div>
        <div class="form-group">
            <label for="tgl_pengembalian">Tanggal Peminjama</label>
            <input type="date" name="tgl_kembali" id="tgl_pengembalian" class="form-control">
        </div>
        <div class="mt-3 mb-3">
            <button class="btn btn-primary" type="submit">
                Simpan Pinjaman
            </button>
            <a href="{{route('books.index')}}" class="btn btn-light btn"> Cancel</a>
        </div>
    </form>
</div>
@endsection