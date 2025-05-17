<?php
namespace App\Http\Controllers\Themes;

class BasicController extends BaseThemeController
{
    public function __construct()
    {
        parent::__construct('basic');
    }

    // ha kell, itt lehet metódusokat felülírni
}
