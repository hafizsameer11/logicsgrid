<?php

namespace Tests;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class CmsTestCase extends TestCase
{
    use RefreshDatabase;

    protected function seedCms(): void
    {
        $this->seed(DatabaseSeeder::class);
    }
}
