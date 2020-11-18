<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListpinjamController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;

        $borrowings = Borrowing::with('user')->where('user_id', $id)->get();

        return view('listpeminjaman.index', compact('borrowings'));

    }
}
