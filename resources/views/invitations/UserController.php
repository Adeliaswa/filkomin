<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // =====================
    // LIST ADMINS
    // =====================
    public function admins()
    {
        $admins = User::where('role', 'admin')->get();

        return view('admin.users.admins.index', compact('admins'));
    }

    // =====================
    // LIST EVENT ORGANIZERS
    // =====================
    public function eventOrganizers()
    {
        $eos = User::where('role', 'eo')->get();

        return view('admin.users.eos.index', compact('eos'));
    }
}
