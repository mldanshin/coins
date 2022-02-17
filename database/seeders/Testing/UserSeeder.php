<?php

namespace Database\Seeders\Testing;

use App\Models\Eloquent\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, "a", "1");
        $this->create(2, "alex", "1990");
        $this->create(3, "max", "18111979");
    }

    private function create(int $id, string $identifier, string $password): void
    {
        $object = new User();
        $object->id = $id;
        $object->identifier = $identifier;
        $object->password = Hash::make($password);
        $object->save();
    }
}
