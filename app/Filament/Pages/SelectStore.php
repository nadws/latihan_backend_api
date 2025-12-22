<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SelectStore extends Page
{
    protected string $view = 'filament.pages.select-store';

    public function getStoresProperty()
    {
        return auth()->user()?->stores ?? collect();
    }

    public function selectStore(int $storeId)
    {
        session(['active_store_id' => $storeId]);

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
