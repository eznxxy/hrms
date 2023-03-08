<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TerminationCategory;
use Carbon\Carbon;

class TerminationCategoryController extends Controller
{
    public function index()
    {
        return view('pages.termination_category.index');
    }
}
