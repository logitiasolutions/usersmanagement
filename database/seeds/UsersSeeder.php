<?php

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

require "vendor/autoload.php";
class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $faker = Faker::create('nl_NL');
       // $faker->addProvider(new UsersFaker($faker));

        DB::table('users')->insert([
            'email'    => 'admin@test.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'first_name' => 'Admin',
            'last_name' => 'Admin'
        ]);

        foreach (range(1, 100) as $index)
        {
            DB::table('users')->insert([
                'email'    => $faker->email,
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'company' => $faker->company,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}