<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use App\Repositories\RoleRepositoryInterface;

class RoleController extends Controller 
{
    private $role;

    public function __construct(RoleRepositoryInterface $roleRepo)
    {
        $this->role = $roleRepo;
    }

    public function get(Request $request)
    {
        $jobs = $this->role->getRoles();
        return response()->json($jobs, 200);
    }
}