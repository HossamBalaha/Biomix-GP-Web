<?php

namespace Database\Seeders;

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
        /*

        php artisan iseed avatars,users,tokens,user_analyses --force
        php artisan iseed sensors,user_sensors,user_sensor_readings --force

        */

        // \App\Models\User::factory(10)->create();
        $this->call(AvatarsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TokensTableSeeder::class);
        $this->call(UserAnalysesTableSeeder::class);
        $this->call(SensorsTableSeeder::class);
        $this->call(UserSensorsTableSeeder::class);
        $this->call(UserSensorReadingsTableSeeder::class);
    }
}
