<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $users = [];
        $faker = \Faker\Factory::create();


        $lastId = DB::table('users')
            ->orderBy('id', 'desc')
            ->select('id')->first();



        $nextId = 1;
        if ($lastId) {

            $nextId = $lastId->id + 1;
        }


        $endId = $nextId + 100;


        for ($i = $nextId; $i <= $endId; $i++) {
            $user = [
                "id" => $i,
                "name" => $faker->name,
                "email" => "test{$i}@test.com",
                "password" => Hash::make('123456'),
                "dial_code" => 91,
                "mobile" => $this->generateIndianMobileNumber(),
                "zip_code" => 6736 . rand(33, 66), // Change the last two numbers
                "city" => $faker->city,
                "district" => $faker->city,
                "state" => $faker->state,
                "country" => $faker->country,
                'referral_code' => $this->generateUniqueCode(),

                'referred_by' => ($i % 6) ? $faker->numberBetween(1, 5) : null,
                "blood_type_id" => rand(1, 8),
                "last_donated_at" => Carbon::now()->subDays(rand(1, 200)), // Set a random previous date
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => null
            ];

            DB::table('users')->insert($user);

        }



        // Insert users into the database

    }
    private function generateIndianMobileNumber()
    {
        $faker = \Faker\Factory::create();
        $prefixes = ['701', '702', '703', '704', '705', '706', '707', '708', '709', '720'];

        return '91' . $faker->randomElement($prefixes) . $faker->numberBetween(1000000, 9999999);
    }



    private function generateUniqueCode()
    {
        do {

            $letters = Str::random(3);
            $numbers = mt_rand(100, 999);
            $mixedString = str_shuffle($letters . $numbers . Str::random(1));

            $referral_code = $mixedString;
        } while (\App\Models\User::where("referral_code", "=", $referral_code)->first());

        return $referral_code;
    }
}
