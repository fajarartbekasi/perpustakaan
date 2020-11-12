<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrowing;
use App\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowings = Borrowing::paginate(5);

        return view('peminjaman.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();

        return view('peminjaman.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'books' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required'
        ]);

        // dd($coba);
        $stock = Book::find($request->books);
        if ($stock->stock <= 0) {
            flash('Maaf Stock Buku Habis', 'danger');
            return redirect()->back();
        }

        $peminjaman = new Borrowing;
        $peminjaman->book_id = $request->books;
        $peminjaman->user_id = auth()->user()->id;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->jumlah_pinjam = $request->jumlah_pinjam;
        $peminjaman->save();

        $book = Book::find($request->books);
        $book->stock = $book->stock - $request->jumlah_pinjam;
        $book->save();
        return redirect()->route('borrowings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, $id)
    {
        $book = Book::find($id);

        return view('peminjaman.create', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        $book = Book::find($borrowing->book_id);

        $book->stock = $book->stock + 1;

        $book->save();

        return redirect()->route('borrowings.index');
    }
}
