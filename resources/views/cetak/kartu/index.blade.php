@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Cetak Kartu Anggota</li>
        </ol>
    </nav>
    <div class="card border-0 shadow-sm">

        <div class="card-body">
            <div class="alert alert-warning" role="alert">
                Silahkan Pilih data anggota yang ingin dicetak kartunya terimakasih
            </div>

            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggotas as $anggota)
                            <tr>
                                <td>{{$anggota->nis}}</td>
                                <td>{{$anggota->name}}</td>
                                <td>{{$anggota->alamat}}</td>
                                <td>{{$anggota->no_handphone}}</td>
                                <td>
                                    <a href="{{route('cetak.detail', $anggota->id)}}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{route('cetak.kartu',$anggota->id)}}" class="btn btn-warning btn-sm">Cetak Kartu</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection