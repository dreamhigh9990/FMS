<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['title' => 'Users']);
    }

    public function getUserList()
    {
    }
}
