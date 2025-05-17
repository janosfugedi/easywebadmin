<?php
// database/seeders/NodeTypeSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NodeType;

class NodeTypeSeeder extends Seeder
{
    public function run(): void {
        $types = [
            ['type' => 'page',     'title' => 'Oldal'],
            ['type' => 'blog',     'title' => 'Blogbejegyzés'],
            ['type' => 'article',  'title' => 'Cikk'],
            ['type' => 'faq',      'title' => 'Gyakori kérdés'],
            ['type' => 'gallery',  'title' => 'Képgaléria'],
            ['type' => 'form',     'title' => 'Űrlap'],
            ['type' => 'event',    'title' => 'Esemény'],
            ['type' => 'redirect', 'title' => 'Átirányítás'],
        ];
        foreach ($types as $type) {
            NodeType::create($type);
        }
    }
}
