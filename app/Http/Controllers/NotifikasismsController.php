<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use App\Borrowing;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class NotifikasismsController extends Controller
{
    public function create($id)
    {
        $borrowing = Borrowing::with('user')->findOrFail($id);

        return view('notifikasi.create', compact('borrowing'));
    }

    public function denda(Request $request,$id)
    {
        $borrowing = Borrowing::with('user')->findOrFail($id);

        $denda = number_format($request->input('denda', 2,',','.'));
        Nexmo::message()->send([
            'to'     => $borrowing->user->no_handphone,
            'from'   => 'SD Jatimulya 08',
            'text'   => 'Assallamuallaikum Wr. Wb. Kami dari perpustakaan
                        ingin memberitahukan bahwa kamu memiliki denda pengembalian buku sebesar Rp'
                        .$denda.'Segera lakukan pengembalian dan membayar denda anda terimakasih'
        ]);

        return redirect()->back()->with(['success'=>'Pesan berhasil dikirim']);

    }

    public function rimainder(Request $request, $id)
    {
        $borrowing = Borrowing::with('user')->findOrFail($id);

        Nexmo::message()->send([
            'to'     => $borrowing->user->no_handphone,
            'from'   => 'SD Jatimulya 08',
            'text'   => 'Assallamuallaikum Wr. Wb. Kami dari perpustakaan
                        ingin memberitahukan bahwa masa berlaku peminjaman kamu tersisa 2 hari lagi
                        harap dikembalikan tepat waktu'
        ]);

        return redirect()->back()->with(['success'=>'Pesan berhasil dikirim']);
    }
}
