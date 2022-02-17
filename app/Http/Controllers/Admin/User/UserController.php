<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::select('name', 'email', 'created_at')->get();

        return view('admin.index', compact('users'));
    }
}
