<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('delete:transaksi')->everyMinute();
        $schedule->call(function(){
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
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
