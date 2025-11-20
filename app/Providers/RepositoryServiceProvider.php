<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EquipRepositoryInterface;
use App\Repositories\Eloquent\EquipRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EquipRepositoryInterface::class, EquipRepository::class);
    }

    public function boot()
    {
        //
    }
}
