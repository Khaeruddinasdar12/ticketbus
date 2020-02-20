<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:transaksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = DB::table('transaksis')
        ->where('status_bayar', 'belum')
        ->where('created_at', '<=', \Carbon\Carbon::now()->subMinutes(1)->toDateTimeString())
        ->get();
        
        foreach ($data as $datas) {
            $set_kursis = \App\Kursi::where('id_jadwal', $datas->id_jadwal)->where('kursi', $datas->no_kursi)
            ->update([
                'status' => 'kosong',
            ]);

            $delete = DB::table('transaksis')->where('id', $datas->id)->delete();
        }
    }
}
