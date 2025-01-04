<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a general report of the resource.
     */
    public function generalReport()
    {
        return view('report.general');
    }

    /**
     * Display a comment report of the resource.
     */
    public function commentReport()
    {
        return view('report.comment');
    }
}
