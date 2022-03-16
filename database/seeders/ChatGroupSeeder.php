<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ChatGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_groups')->insert([
            'name' => 'Todos los chats'
        ]);

        DB::table('chat_groups')->insert([
            'name' => 'Privado'
        ]); 
    }
}
