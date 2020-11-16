<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index()
    {
        $anggotas = Role::with('users')->where('name','anggota')->get();

        return view('cetak.kartu.index', compact('anggotas'));
    }

    public function show($id)
    {
        $anggota = Role::with('users')->where('name','anggota')->findOrFail($id);

        return view('cetak.kartu.show',compact('anggota'));
    }
    public function cetak($id)
    {
        $anggota = Role::with('users')->where('name','anggota')->findOrFail($id);

        $pdf = PDF::loadView('cetak.kartu.anggota', compact('anggota'))->setPaper('a4', 'potrait');

        return $pdf->stream('kartu_anggota.pdf');
    }
}
