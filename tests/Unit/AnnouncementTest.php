<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Announcement;
use App\Models\JobPosition;
use Faker\Provider\Uuid;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_announcements_success_should_return_status_200()
    {
        $this->get('api/academic-industry')->assertStatus(200);
    }

    public function test_post_announcement_success_should_return_announcement()
    {
        $data = [
            'company_id' => $this->faker->company_id,
            'announcement_title' => 'รับสมัครงานตำแหน่ง Software Engineer',
            'job_description' => 'เป็นซอฟ์ตแวร์เอน เอนแบบเอนเตอร์เทน',
            'job_position_id' => $this->fakerJobPosition->job_position_id,
            'property' => 'ขยันเป็นพอ',
            'picture' => 'path/picture',
            'start_date' => '2021-01-10 13:00:00',
            'end_date' => '2021-03-31 17:00:00',
            'welfare' => 'เงินดี ไม่ต้องแย่งลงทะเบียน',
            'status' => 'เปิดรับสมัคร',
            'job_type' => 'WiL'
        ];

        $response = $this->postJson('api/academic-industry', $data);
        $response->assertStatus(200);

        $response_arr = json_decode($response->content(), true);
        $announcement = Announcement::find($response_arr['announcement_id']);
        $announcement_arr = $announcement->toArray()['announcement_id'];

        $this->assertEquals($announcement_arr, $response_arr['announcement_id']);
    }

    public function test_post_announcement_fail_should_return_500()
    {
        $data = [
            'company_id' => $this->faker->company_id,
            'job_description' => 'เป็นซอฟ์ตแวร์เอน เอนแบบเอนเตอร์เทน',
            'job_position_id' => $this->fakerJobPosition->job_position_id,
            'property' => 'ขยันเป็นพอ',
            'picture' => 'path/picture',
            'start_date' => '2021-01-10 13:00:00',
            'end_date' => '2021-03-31 17:00:00',
            'welfare' => 'เงินดี ไม่ต้องแย่งลงทะเบียน',
            'status' => 'เปิดรับสมัคร',
            'job_type' => 'WiL'
        ];

        $response = $this->postJson('api/academic-industry', $data);
        $response->assertStatus(500);
    }
}
