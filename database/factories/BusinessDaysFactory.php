<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Faker\Provider\Uuid;

use App\Models\BusinessDays;
use App\Models\Company;

$factory->define(BusinessDays::class, function (Faker $faker) use ($factory){
    return [
        'business_day_id' => Uuid::uuid(),
        'business_day_type' => 'announcement',
        'company_id' => $factory->create(Company::class)->company_id,
        'start_business_day' => 'จันทร์',
        'end_business_day' => 'ศุกร์',
        'start_business_time' => '06:00',
        'end_business_time' => '19:00'
    ];
});
