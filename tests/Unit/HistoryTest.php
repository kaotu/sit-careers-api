<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_histories_success_should_return_status_200()
    {
        $this->get('api/histories')->assertStatus(200);
    }
}
