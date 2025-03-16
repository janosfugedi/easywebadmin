<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LinkThemes extends Command
{
    protected $signature = 'themes:link';
    protected $description = 'Szimbolikus link létrehozása a themes könyvtárhoz';

    public function handle()
    {
        $target = base_path('themes');
        $link = public_path('themes');

        if (file_exists($link)) {
            $this->warn("A public/themes már létezik.");
            return;
        }

        symlink($target, $link);
        $this->info("Szimbolikus link létrehozva: public/themes -> themes");
    }
}
