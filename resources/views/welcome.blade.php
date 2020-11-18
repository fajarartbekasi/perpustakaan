@extends('layouts.index')


@section('content')

<div class="row">
    <div class="col-md-3">
        <ul class="list-group shadow-sm">
            <li class="list-group-item border-0 active">Rak Buku</li>
            @foreach($raks as $rak)
                <li class="list-group-item border-0 ">{{$rak->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-9">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-4 pt-3">
                            <div class="card" >
                                <img src="{{ url('storage/'. $book->images) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$book->name}}</h5>
                                    <p class="card-text">{{$book->description}}</p>
                                    <a href="{{route('borrowings.edit', $book->id)}}" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{$books->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection