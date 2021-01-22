<?php

namespace Tests\Unit;

use Tests\TestCase;

use Faker\Provider\Uuid;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Announcement;
use App\Models\JobType;

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

    public function test_post_announcement_fail_should_return_status_500()
    {
        //Filed announcement_title missing
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

    public function test_update_announcement_success_should_return_announcement_that_has_been_updated()
    {
        $jobType = factory(JobType::class)->create([
            "announcement_id" => $this->fakerAnnouncement->announcement_id,
            "job_id" => Uuid::uuid()
        ]);

        $data = [
            'announcement_id' => $this->fakerAnnouncement->announcement_id,
            'company_id' => $this->faker->company_id,
            'announcement_title' => 'รับสมัครงานตำแหน่ง UX/UI',
            'job_description' => 'ต้องการ UX/UI',
            'job_position_id' => $this->fakerJobPosition->job_position_id,
            'property' => 'ขยันเป็นพอ',
            'picture' => 'path/picture',
            'start_date' => '2021-01-10 13:00:00',
            'end_date' => '2021-03-31 17:00:00',
            'welfare' => 'เงินดี ไม่ต้องแย่งลงทะเบียน',
            'status' => 'เปิดรับสมัคร',
            'job_type' => 'WiL'
        ];

        $response = $this->putJson('api/academic-industry', $data);
        $response->assertStatus(200);

        $response_arr = json_decode($response->content(), true);
        $announcement = Announcement::find($response_arr['announcement_id']);
        $announcement_arr = $announcement->toArray();

        $this->assertEquals($announcement_arr['announcement_id'], $response_arr['announcement_id']);
        $this->assertEquals($announcement_arr['job_description'], $response_arr['job_description']);
    }

    public function test_update_announcement_fail_should_return_status_500()
    {
        $jobType = factory(JobType::class)->create([
            "announcement_id" => $this->fakerAnnouncement->announcement_id,
            "job_id" => Uuid::uuid()
        ]);

        //Filed announcement_id (pk) missing
        $data = [
            'company_id' => $this->faker->company_id,
            'announcement_title' => 'รับสมัครงานตำแหน่ง UX/UI',
            'job_description' => 'ต้องการ UX/UI',
            'job_position_id' => $this->fakerJobPosition->job_position_id,
            'property' => 'ขยันเป็นพอ',
            'picture' => 'path/picture',
            'start_date' => '2021-01-10 13:00:00',
            'end_date' => '2021-03-31 17:00:00',
            'welfare' => 'เงินดี ไม่ต้องแย่งลงทะเบียน',
            'status' => 'เปิดรับสมัคร',
            'job_type' => 'WiL'
        ];

        $response = $this->putJson('api/academic-industry', $data);
        $response->assertStatus(500);
    }

    public function test_delete_announcement_by_id_success_should_return_status_200()
    {
        $jobType = factory(JobType::class)->create([
            "announcement_id" => $this->fakerAnnouncement->announcement_id,
            "job_id" => Uuid::uuid()
        ]);

        $data = [
            'announcement' => $this->fakerAnnouncement
        ];

        $response = $this->deleteJson('api/academic-industry', $data);
        $response->assertStatus(200);
    }
}
