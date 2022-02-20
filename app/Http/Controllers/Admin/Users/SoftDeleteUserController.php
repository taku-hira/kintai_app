<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class SoftDeleteUserController extends Controller
{
    public function index()
    {
        $soft_delete_users = User::onlyTrashed()->get();

        return view('admin.soft_delete_users.index', compact('soft_delete_users'));
    }

    public function destroy($id)
    {
        $delete_user = User::onlyTrashed()->where('id', $id)->first();

        $delete_user->forceDelete();

        return redirect()->route('admin.soft_delete_users.index')->with('flash_message', '完全に削除しました');
    }
}
