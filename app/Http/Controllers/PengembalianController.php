<?php

namespace App\Http\Controllers;

use PDF;
use App\Borrowing;
use App\Pengembalian;
use App\Book;
Use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $date = now();
        $borrowings = Borrowing::paginate(5);

        return view('pengembalian.index', compact('date','borrowings'));
    }
    public function create($id)
    {
        $date = now();
        $pengembalian = Borrowing::findOrFail($id);

        return view('pengembalian.create', compact('pengembalian','date'));
    }
    public function store(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $this->validate($request,[
            'durasi'        => 'required',
            'jumlah_pinjam' => 'required',
            'denda'         => 'required',
            'tgl_pinjm'    => 'required',
            'tgl_kembali'   => 'required',

        ]);

        $pengembalian = Pengembalian::create([
            'book_id'       => $borrowing->book->id,
            'user_id'       => $borrowing->user->id,
            'durasi'        => $request->input('durasi'),
            'jumlah_pinjam' => $request->input('jumlah_pinjam'),
            'denda'         => $request->input('denda'),
            'tgl_pinjm'     => $request->input('tgl_pinjm'),
            'tgl_kembali'   => $request->input('tgl_kembali'),
        ]);

        $borrowing->delete();

        $book = Book::find($borrowing->book_id);

        $book->stock = $book->stock + 1;

        $book->save();

        return redirect()->route('pengembalian.index')->with(['success', 'Pengembalain behasil dilakukan']);
    }
    public function show()
    {
        $date = now();
        $pengembalians = Pengembalian::paginate(5);

        return view('laporan.pengembalian.index', compact('pengembalians','date'));
    }

    public function periode(Request $request)
    {
        if ($request->has('tgl_awal')) {
            $pengembalian = Pengembalian::with('user','book')->whereBetween('tgl_pinjm', [request('tgl_awal'), request('tgl_akhir')])
                                    ->get();
        }
        $pdf = PDF::loadView('laporan.pengembalian.periode', compact('pengembalian'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_periode_pengembalian.pdf');
    }
    public function all()
    {
        $pengembalians = Pengembalian::all();

        $pdf = PDF::loadView('laporan.pengembalian.all', compact('pengembalians'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_laporan_semua_peminjaman.pdf');
    }
}
