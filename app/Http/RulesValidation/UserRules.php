<?php

namespace App\Http\RulesValidation;

use Illuminate\Contracts\Validation\Rule;

trait UserRules
{
    private $rulesCreationUser = [
        'role_id' => 'required|string',
        'email' => 'required|string'
    ];

    private $rulesUpdateUser = [
        'role_id' => 'required|string',
        'user_id' => 'required|string',
        'email' => 'required|string'
    ];
}
