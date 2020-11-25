<?php

namespace App\Http\Controllers\Laporan;

use PDF;
use App\User;
use App\Book;
use App\Borrowing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function periode(Request $request)
    {
        if ($request->has('tgl_awal')) {
            $borrowings = Borrowing::with('user','book')->whereBetween('tgl_pinjam', [request('tgl_awal'), request('tgl_akhir')])
                                    ->get();
        }
        $pdf = PDF::loadView('laporan.peminjaman.periode', compact('borrowings'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_periode_peminjaman.pdf');
    }
}
