<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'company_name' => 'Cyber Zee',
            'chief' => 'Zen',
            'city' => 'Semarang',
            'zip_code' => '50179',
            'address1' => 'Jl. Erowati Raya No.35, Bulu Lor, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50179 (Samping Indomaret Persis)',
            'phonecode' => 62,
            'phone' => '81355053708',
            'telp' => '0241234567',
            'email' => 'cyberzee@mailinator.com'
        ]);
    }
}
