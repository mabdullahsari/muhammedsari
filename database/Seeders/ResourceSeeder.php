<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;

final class ResourceSeeder extends Seeder
{
    public function run(SQLiteConnection $db): void
    {
        $db->table('resources')->insert([
            [
                'id' => 1,
                'category' => 'Laptop',
                'name' => '14‑inch MacBook Pro / M1 Pro',
                'sort' => 1,
            ],
            [
                'id' => 2,
                'category' => 'Monitor',
                'name' => 'LG UltraGear 27GL850 / 27-inch',
                'sort' => 2,
            ],
            [
                'id' => 3,
                'category' => 'Monitor',
                'name' => 'Dell UltraSharp U2720Q / 27-inch',
                'sort' => 3,
            ],
            [
                'id' => 4,
                'category' => 'Keyboard',
                'name' => 'Corsair K95 RGB / Cherry MX Red',
                'sort' => 4,
            ],
            [
                'id' => 5,
                'category' => 'Keyboard',
                'name' => 'Apple Wireless Keyboard / 4th gen',
                'sort' => 5,
            ],
            [
                'id' => 6,
                'category' => 'Mouse',
                'name' => 'SteelSeries Rival 300 / Black',
                'sort' => 6,
            ],
            [
                'id' => 7,
                'category' => 'Mouse',
                'name' => 'Microsoft Surface Mouse / Silver',
                'sort' => 7,
            ],
            [
                'id' => 8,
                'category' => 'Speakers',
                'name' => 'Logitech Z200 / Wireless',
                'sort' => 8,
            ],
            [
                'id' => 9,
                'category' => 'Headphones',
                'name' => 'Sony WH-1000XM3 / Black',
                'sort' => 9,
            ],
            [
                'id' => 10,
                'category' => 'Chair',
                'name' => 'Herman Miller Aeron',
                'sort' => 10,
            ],
            [
                'id' => 11,
                'category' => 'Chair',
                'name' => 'Maxnomic "Classic Office"',
                'sort' => 11,
            ],
        ]);
    }
}
