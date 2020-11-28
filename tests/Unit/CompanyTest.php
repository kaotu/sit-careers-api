<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Faker\Provider\Uuid;

use App\Http\Controllers\CompanyController;
use App\Repositories\CompanyRepository;
use App\Models\Company;

use App\Models\Address;
use App\Models\MOU;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_companies_success_should_return_status_200()
    {
        $this->get('api/companies')->assertStatus(200);
    }

    public function test_post_company_success_should_return_company()
    {
        $data = [
            'company_id' => $this->faker->company_id, 
            'company_name_th' => 'บริษัท เทส จำกัด',
            'company_name_en' => 'Test COmpany',
            'description' => 'เป็นบริษัทพัฒนา software บริษัทใหญ่ อยู่เยอรมัน',
            'about_us' => 'อยากเท่ อยากเจ๋ง มาเข้าบริษัทนี้',
            'logo' => 'path/to/logo',
            'company_type' => 'Technology',
            'start_business_day' => 'จันทร์',
            'end_business_day' => 'ศุกร์',
            'start_business_time' => '07:00',
            'end_business_time' => '18:00',
            'e_mail_coordinator' => 'test@gmail.com',
            'e_mail_manager' => 'company@gmail.com',
            'tel_no' => '0988882356',
            'phone_no' => '0298987645',
            'website' => 'http://test.com',
            "address_one" => "138/2 หอพักสตรีพสิษฐ์",
            "address_two" => "-",
            "lane" => "2",
            "road" => "วิภาวดีรังสิต",
            "sub_district" => "ดินแดง",
            "district" => "ดินแดง",
            "province" => "กรุงเทพ",
            "postal_code" => "10400",
            "mou_type" => "ชนิด MOU",
            "mou_link" => "https://www.google.co.th",
            "contact_period" => "30 กันยายน 2563 - 30 กันยายน 2565"
        ];
        
        $response = $this->postJson('api/company', $data);
        $response->assertStatus(200);
        
        $response_arr = json_decode($response->content(), true);
        $company = Company::find($response_arr['company_id']);
        $company_arr = $company->toArray()['company_id'];

        $this->assertEquals($company_arr, $response_arr['company_id']);
    }

    public function test_update_company_success_should_return_company_that_had_been_updated()
    {
        $address = factory(Address::class)->create([
            "company_id" => $this->faker->company_id,
            "address_id" => Uuid::uuid()
        ]);
        $mou = factory(MOU::class)->create([
            "company_id" => $this->faker->company_id,
            "mou_id" => Uuid::uuid()
        ]);

        $data = [
            'company_id' => $this->faker->company_id,
            'company_name_th' => 'บริษัท ฮัลโหล จำกัด',
            'company_name_en' => 'TEST COMPANY',
            'description' => 'เป็นบริษัทพัฒนา software บริษัทใหญ่ อยู่เยอรมัน',
            'about_us' => 'อยากเท่ อยากเจ๋ง มาเข้าบริษัทนี้',
            'logo' => 'path/to/logo',
            'company_type' => 'Technology',
            'start_business_day' => 'จันทร์',
            'end_business_day' => 'ศุกร์',
            'start_business_time' => '07:00',
            'end_business_time' => '18:00',
            'e_mail_coordinator' => 'test@gmail.com',
            'e_mail_manager' => 'company@gmail.com',
            'tel_no' => '0988882356',
            'phone_no' => '0298987645',
            'website' => 'http://test.com',
            "address_one" => "138/2 พรีวิวหอพัก",
            "address_two" => "-",
            "lane" => "9",
            "road" => "วิภาวดีรังสิต",
            "sub_district" => "ดินแดง",
            "district" => "ดินแดง",
            "province" => "กรุงเทพ",
            "postal_code" => "10400",
            "mou_type" => "ชนิด MOU",
            "mou_link" => "https://www.google.co.th",
            "contact_period" => "30 กันยายน 2563 - 30 กันยายน 2565"
        ];

        $response = $this->putJson('api/company', $data);
        $response->assertStatus(200);
        
        $response_arr = json_decode($response->content(), true);
        $company = Company::find($response_arr['company_id']);
        $company_arr = $company->toArray();

        // Check field that are changed
        $this->assertEquals($company_arr['company_id'], $response_arr['company_id']);
        $this->assertEquals($company_arr['company_name_th'], $response_arr['company_name_th']);
    }
}
