<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('donations')->truncate();

        Schema::enableForeignKeyConstraints();

        $users = User::all();

        foreach ($users as $user) {
            Donation::factory(3)->create([
                'user_id' => $user->id,
                'donator_name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }
}
