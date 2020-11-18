<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            $id = Auth::id(),
            'book'      => Book::all(),
            'borrowing' => Borrowing::withCount('user')
                            ->where('user_id', $id)
                            ->get(),
        ];
       return view('home', $data);
    }
}
