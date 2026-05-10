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

        $annisaId = DB::table('users')->where('email', 'annisa@gmail.com')->value('id');
        $aidilId = DB::table('users')->where('email', 'aidil@gmail.com')->value('id');
        $fikriId = DB::table('users')->where('email', 'fikri@gmail.com')->value('id');

        DB::table('set_roles')->insert([
            ['user_id' => $annisaId, 'role_id' => $buyerRoleId],
            ['user_id' => $aidilId, 'role_id' => $buyerRoleId],
            ['user_id' => $aidilId, 'role_id' => $sellerRoleId],
            ['user_id' => $fikriId, 'role_id' => $buyerRoleId],
        ]);
    }
}
