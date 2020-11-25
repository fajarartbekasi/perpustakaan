<?php

namespace App\Http\Controllers\Laporan;

use PDF;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanbukuController extends Controller
{
    public function rekapbuku()
    {
        $bukus = Book::with('category')->get();

        $pdf = PDF::loadView('laporan.buku.rekap', compact('bukus'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_laporan_buku.pdf');
    }
}
