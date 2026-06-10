<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyerRoleId = DB::table('roles')->where('role_name', 'pembeli')->value('id');
        $sellerRoleId = DB::table('roles')->where('role_name', 'penjual')->value('id');

        $pembeliId = DB::table('users')->where('email', 'pembeli@gmail.com')->value('id');
        $penjualId = DB::table('users')->where('email', 'penjual@gmail.com')->value('id');
        $annisaId  = DB::table('users')->where('email', 'annisa@gmail.com')->value('id');
        $aidilId   = DB::table('users')->where('email', 'aidil@gmail.com')->value('id');

        DB::table('set_roles')->insert([
            // pembeli@gmail.com → role pembeli
            ['user_id' => $pembeliId, 'role_id' => $buyerRoleId],
            // penjual@gmail.com → role pembeli + penjual
            ['user_id' => $penjualId, 'role_id' => $buyerRoleId],
            ['user_id' => $penjualId, 'role_id' => $sellerRoleId],
            // annisa@gmail.com → role pembeli
            ['user_id' => $annisaId,  'role_id' => $buyerRoleId],
            // aidil@gmail.com → role pembeli + penjual
            ['user_id' => $aidilId,   'role_id' => $buyerRoleId],
            ['user_id' => $aidilId,   'role_id' => $sellerRoleId],
        ]);
    }
}
