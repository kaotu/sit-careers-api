<?php

namespace App\Http\RulesValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Validator;

trait CompanyRules
{
    private $rulesCreationCompany = [
        'company_name_th' => 'required|string',
        'company_name_en' => 'required|string',
        'company_type' => 'required|string',
        'description' => 'required|string',
        'about_us' => 'required|string',
        'logo' => 'required|string',
        'start_business_day' => 'required|string',
        'end_business_day' => 'required|string',
        'start_business_time' => 'required|string',
        'end_business_time' => 'required|string',
        'e_mail_coordinator' => 'required|email|unique:companies',
        'e_mail_manager' => 'required|email|unique:companies',
        'tel_no' => 'required|max:10|min:10',
        'phone_no' => 'required|max:10|min:10',
        'website' => 'required',
        "address_one" => "required|string",
        "address_two" => "string",
        "lane" => "string",
        "road" => "string",
        "sub_district" => "required|string",
        "district" => "required|string",
        "province" => "required|string",
        "postal_code" => "required|string|max:5",
    ];

    private $rulesGetCompanyById = [
        'company_id' => 'required|string'
    ];
}