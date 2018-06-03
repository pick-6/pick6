<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fakeUsers();
    }

    protected function fakeUsers()
    {
    	$faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            $users = new \App\User();
            $users->first_name = $faker->firstNameMale;
            $users->last_name = $faker->lastName;
            $users->username = $faker->userName;
            $users->email = $faker->safeEmail;
            $users->credit = 6;
            $users->avatar = "default.png";
            $users->password = bcrypt($faker->password);
            $users->save();
    	}
	}
}
