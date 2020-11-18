@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="float-left">
                            {{ $borrowing->sum('jumlah_pinjam') }}
                        </h4>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"
                             class="float-right d-block"
                             width="20" hight="20">
                            <path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z" />
                        </svg>
                        <br>
                    </div>
                    <div class="mt-3 ">
                        <h3 class="text-muted mt-3">
                            Jumlah Buku yang dipinjam
                        </h3>
                    </div>

                    <div class="pt-3">
                        <a href="{{route('list-peminjaman')}}" class="btn btn-info">Lihat daftar peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="float-left">
                            {{ $book->sum('stock') }}
                        </h4>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="float-right d-block" width="20"
                            hight="20">
                            <path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z" />
                        </svg>
                        <br>
                    </div>
                    <div class="mt-3 ">
                        <h3 class="text-muted mt-3">
                            Jumlah Buku
                        </h3>
                    </div>
                    <div class="pt-3">
                        <a href="{{route('books.index')}}" class="btn btn-info">Cek daftar buku </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
