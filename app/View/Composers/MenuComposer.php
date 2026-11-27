<?php

namespace App\View\Composers;

use App\Support\StoreMenu;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        $view->with(StoreMenu::get());
    }
}