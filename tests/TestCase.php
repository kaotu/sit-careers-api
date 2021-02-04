<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Models\Announcement;
use App\Models\Address;
use App\Models\Company;
use App\Models\JobPosition;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected $faker;
    protected $fakerJobPosition;
    protected $fakerAnnouncement;


    public function setUp() :void {
        parent::setUp();
        $this->faker = factory(Company::class)->create();
        $this->fakerJobPosition = factory(JobPosition::class)->create();
        $this->fakerAddress = factory(Address::class)->create();
        $this->fakerAnnouncement = factory(Announcement::class)->create();
    }
}
