<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            'admin',
            'user',
        ];

        DB::beginTransaction();

        foreach ($userTypes as $type) {
            UserType::updateOrCreate(['name' => $type]);
        }

        $adminType = UserType::where('name', 'admin')->first();

        User::where('email', 'test@example.com')->update(['user_type_id' => $adminType->id]);
        DB::commit();
    }
}
