<?php

namespace Tests;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class AbstractTestCase
 *
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
abstract class AbstractTestCase extends TestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected $faker;

    protected $user;

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->user = factory(\App\Models\User::class)->create();
        $this->actingAs($this->user);
    }

    /**
     * Reset the migrations
     */
    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
