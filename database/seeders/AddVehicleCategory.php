<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleCategory;

class AddVehicleCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat  = ['Truck','Bike','Four Wheeler'];
        foreach ($cat as $key => $value) {
            $vehicleCategory = new VehicleCategory();
            $vehicleCategory->name = $value;
            $vehicleCategory->save();
        }
    }
}
