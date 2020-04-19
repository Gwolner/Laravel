<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Guilherme Wolner',
        //     'email' => 'gwdm@recife.com.br',
        //     'password' => bcrypt('123456'), //Criptografa a senha, pois ela não pode ser direta aqui
        // ]);
        //Após preencher estes dados, usar php artisan db:seed para add o usuario ao BD!

        factory(User::class,10)->create();
        //Usar o comando php artisan db:seed

        //Criar factory: php artisan make:factory ProductFactory --model=Models\\Product
        //OBS: Tem que existir o model product conforme parametro passado acima no model!


    }
}
