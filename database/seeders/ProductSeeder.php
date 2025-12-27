<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;
use Ramsey\Identifier\Ulid\UlidFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Db::table('accounts')->insert([
                'uuid' => (new UlidFactory)->create()->toString(),
                'name' => $faker->name(),
                'email' => $faker->unique()->freeEmail(),
            ]);
        }
    }
}
