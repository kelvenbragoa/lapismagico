<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('taxes')->insert([
            [
                'id' =>1,
                'name' => 'Matrícula',
                'amount'=>1500
            ],
            [
                'id' =>2,
                'name' => 'Taxa de Inscrição',
                'amount'=>100
            ],
            [
                'id' =>3,
                'name' => 'Boletim de Inscrição',
                'amount'=>50
            ],
            [
                'id' =>4,
                'name' => 'Propina Mensal',
                'amount'=>2000
            ],
            [
                'id' =>5,
                'name' => 'Propina Trimestral',
                'amount'=>6000
            ],
          
            [
                'id' =>6,
                'name' => 'Propina Semestral',
                'amount'=>12000
            ],

            [
                'id' =>7,
                'name' => 'Propina Anual',
                'amount'=>24000
            ],
           ]);

           DB::table('payment_frequencies')->insert([
            [
                'id' =>1,
                'name' => 'Mensal',
                'months' => 1,
                'amount'=>2000
            ],
            [
                'id' =>2,
                'name' => 'Trimestral',
                'months' => 3,
                'amount'=>6000
                

            ],
            [
                'id' =>3,
                'name' => 'Semestral',
                'months' => 6,
                'amount'=>12000

            ],
            [
                'id' =>4,
                'name' => 'Anual',
                'months' => 12,
                'amount'=>24000

            ],
           ]);


        DB::table('registration_statuses')->insert([
            [
                'id'=>1,
                'name'=>'Pendente',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Ativo',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Inativo',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ]);

        DB::table('users')->insert([
            [
                'id'=>1,
                'firstName'=>'Pedro',
                'lastName'=>'Leandro',
                'mobile'=>'84000000',
                'role_id'=>1,
                'account_status_id'=>1,
                'email'=>'gpiniciative@gmail.com',
                'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ]);

        DB::table('company_configs')->insert([
            [
                'id'=>1,
                'name'=>'Lapis Magico',
                'image'=>'/files/img/sys/image.png',
                'address'=>'Rua Alfredo Lawley, Esturro - Beira, Moçambique',
                'mobile'=>'+258 87 9945 530',
                'email'=>'gpiniciative@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
         
        ]);

        DB::table('account_statuses')->insert([
            [
                'id'=>1,
                'name'=>'Ativado',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Desativado',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
        DB::table('documents')->insert([
            [
                'id'=>1,
                'name'=>'BI',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Passaporte',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Cédula',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>4,
                'name'=>'D.I.R.E',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);

        DB::table('degree_of_kinships')->insert([
            [
                'id'=>1,
                'name'=>'Pai',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Mãe',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Tio',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>4,
                'name'=>'Tia',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>5,
                'name'=>'Primo',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>6,
                'name'=>'Prima',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>7,
                'name'=>'Avó',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>8,
                'name'=>'Avô',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);

        DB::table('genders')->insert([
            [
                'id'=>1,
                'name'=>'Masculino',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Feminino',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);

        DB::table('countries')->insert([
            [
                'id'=>1,
                'name'=>'Mozambique',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);

        DB::table('roles')->insert([
            [
                'id'=>1,
                'name'=>'Administrador',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            
        ]);

        DB::table('provinces')->insert([
            [
                'id' =>1,
                'country_id'=>1,
                'name' => 'Maputo Cidade',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>2,
                'country_id'=>1,
                'name' => 'Maputo Província',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>3,
                'country_id'=>1,
                'name' => 'Inhambane',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>4,
                'country_id'=>1,
                'name' => 'Gaza',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>5,
                'country_id'=>1,
                'name' => 'Sofala',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>6,
                'country_id'=>1,
                'name' => 'Manica',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>7,
                'country_id'=>1,
                'name' => 'Tete',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>8,
                'country_id'=>1,
                'name' => 'Zambézia',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>9,
                'country_id'=>1,
                'name' => 'Nampula',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>10,
                'country_id'=>1,
                'name' => 'Cabo Delgado',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id' =>11,
                'country_id'=>1,
                'name' => 'Niassa',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
           ]);

           DB::table('cities')->insert([
            [
                'id'=>1,
                'name'=>'Maputo',
                'province_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Matola',
                'province_id'=>2,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Nampula',
                'province_id'=>9,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>4,
                'name'=>'Beira',
                'province_id'=>5,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>5,
                'name'=>'Chimoio',
                'province_id'=>6,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>6,
                'name'=>'Quelimane',
                'province_id'=>8,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>7,
                'name'=>'Nacala',
                'province_id'=>9,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>8,
                'name'=>'Mocuba',
                'province_id'=>8,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>9,
                'name'=>'Tete',
                'province_id'=>7,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>10,
                'name'=>'Gurué',
                'province_id'=>8,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>11,
                'name'=>'Lichinga',
                'province_id'=>11,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>12,
                'name'=>'Pemba',
                'province_id'=>10,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>13,
                'name'=>'Xai-Xai',
                'province_id'=>4,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>14,
                'name'=>'Maxixe',
                'province_id'=>3,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>15,
                'name'=>'Angoche',
                'province_id'=>9,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>16,
                'name'=>'Cuamba',
                'province_id'=>11,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>17,
                'name'=>'Montepuez',
                'province_id'=>10,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>18,
                'name'=>'Dondo',
                'province_id'=>5,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>19,
                'name'=>'Inhambane',
                'province_id'=>3,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>20,
                'name'=>'Chibuto',
                'province_id'=>4,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>21,
                'name'=>'Chócue',
                'province_id'=>4,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>22,
                'name'=>'Ilha de Moçambique',
                'province_id'=>9,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>23,
                'name'=>'Manica',
                'province_id'=>6,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>24,
                'name'=>'Moatiza',
                'province_id'=>7,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>25,
                'name'=>'Vilanculos',
                'province_id'=>3,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ]);
    }
}
