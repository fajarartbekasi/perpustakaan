<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use Intervention\Image\Facades\Image;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
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

        $books = Book::paginate(5);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();

        return view('books.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       $book = Book::create($this->validateRequest());

       $this->storeImage($book);

        flash()->success('Buku berhasi ditambahkan');

        return redirect()->route('books.index');
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
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'penerbit' => 'required',
            'tanggal_terbit' => 'required|date',
            'stock' => 'required|integer'
        ]);

        $book->update($request->all());

        flash()->success('data buku berhasil diupdate.');

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        flash()->success('selamat buku berhasil dihapus.');

        return redirect()->route('books.index');
    }

    private function validateRequest(){
        return tap(request()->validate([
            'category_id'       => 'required',
            'name'              => 'required',
            'description'       => 'required',
            'penerbit'          => 'required',
            'tanggal_terbit'    =>  'required',
            'stock'             =>  'required',
            'images'    => 'required|image|max:5000',
        ]), function(){
            if(request()->hasFile('images')){
                request()->validate([
                    'images'    => 'required|image|max:5000',
                ]);
            }
        });
    }

    private function storeImage($book){
        if(request()->has('images')){
            $book->update([
                'images'  => request()->images->store('uploads','public'),
            ]);

            $image = Image::make(public_path('storage/'. $book->images))->fit(300,300, null, 'top-left');
            $image->save();
        }
    }
}
