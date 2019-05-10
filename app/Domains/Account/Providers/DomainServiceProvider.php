<?php

namespace App\Domains\Account\Providers;

use App\Support\Domains\ServiceProvider;
use App\Domains\Account\Database\Seeders;
use App\Domains\Account\Database\Factories;
use App\Domains\Account\Database\Migrations;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Domain alias for resources.
     *
     * @var string
     */
    protected $alias = 'account';

    /**
     * List of migrations provided by Domain.
     *
     * @var array
     */
    protected $migrations = [
        Migrations\CreateUsersTable::class,
        Migrations\CreatePasswordResetsTable::class,
    ];

    /**
     * List of seeders provided by Domain.
     *
     * @var array
     */
    protected $seeders = [
        Seeders\UserSeeder::class,
    ];

    /**
     * List of model factories to load.
     *
     * @var array
     */
    protected $factories = [
        Factories\UserFactory::class,
    ];
}
