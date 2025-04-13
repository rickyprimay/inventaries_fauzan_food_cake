<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outlets')->insert([
            [
                "outlet_name" => "Outlet 1",
                "outlet_address" => "Jl. Outlet 1 No. 1",
                "city" => "Semarang",
                "is_central_kitchen" => false,
            ],
            [
                "outlet_name" => "Outlet 2",
                "outlet_address" => "Jl. Outlet 2 No. 2",
                "city" => "Jakarta",
                "is_central_kitchen" => true,
            ],
            [
                "outlet_name" => "Outlet 3",
                "outlet_address" => "Jl. Outlet 3 No. 3",
                "city" => "Bandung",
                "is_central_kitchen" => false,
            ],
        ]);
    }
}
