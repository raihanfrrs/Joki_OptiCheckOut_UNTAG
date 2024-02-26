<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function getAllAdmins()
    {
        return Admin::all();
    }

    public function getAdmin($id)
    {
        return Admin::find($id);
    }
}