<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\User;
use App\Borrowing;
use Illuminate\Console\Command;
use Nexmo\Laravel\Facade\Nexmo;

class NotifySms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Pengembalian Buku';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $peminjaman = Borrowing::with('user')->get();
        
        $date = Carbon::now();

        foreach ($peminjaman as $hitungtanggal) {
            if ($date->diffInDays($hitungtanggal->tgl_pinjam) == 5) {
                return Nexmo::message()->send([
                            'to'     => $hitungtanggal->user->no_handphone,
                            'from'   => 'SMP ASSALAM',
                            'text'   => 'Assallamuallaikum Wr. Wb. Kami dari perpustakaan
                                        ingin memberitahukan bahwa masa peminjaman buku anda sudah mendekati batas waktunya harap dikembalikan seblum jatuh tempo'
                        ]);
            }
           
        }
    }
}
