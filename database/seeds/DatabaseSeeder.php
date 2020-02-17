<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TipeBus::class);
        $this->call(BusSeed::class);
        $this->call(RuteSeed::class);
        $this->call(PivotBusRutes::class);
        $this->call(JadwalSeed::class);
        $this->call(KursiSeed::class);
        $this->call(TransaksiSeed::class);

    }
}
