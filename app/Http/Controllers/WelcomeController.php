<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $raks = Category::all();

        $books = Book::paginate(6);
        return view('welcome', compact('raks','books'));
    }
}
