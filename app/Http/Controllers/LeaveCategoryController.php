<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class LeaveCategoryController extends Controller
{
    public function index()
    {
        return view('pages.leave_category.index');
    }
}
