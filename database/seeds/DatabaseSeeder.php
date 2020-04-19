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
        $this->call(UserTableSeeder::class);

        // Criar seeders via comando php artisan make:seeder UserTableSeeder //Sempre neste padrão!
        // Se criar manualmente, deve-se  usar o commando que dá reload no compoder (veja em migrations)
    }
}
