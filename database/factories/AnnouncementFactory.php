<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Faker\Provider\Uuid;

use App\Model\Announcement;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'announcement_id' => Uuid::uuid(),
        'announcement_title' => 'รับสมัคร Software Engineer',
        'job_description' => 'มาสมัครงานกับเรา ได้ทำทุกอย่างที่อยากทำ',
        'property' => 'คนดี ก็เพียงพอ',
        'picture' => 'path/picture',
        'start_date' => '2021-01-10 13:00:00',
        'end_date' => '2021-02-10 18:00:00',
        'welfare' => 'มีเงินเดือนให้',
        'status' => 'เปิดรับสมัคร'
    ];
});
