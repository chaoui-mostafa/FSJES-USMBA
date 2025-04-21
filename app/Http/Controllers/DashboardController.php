<?php

namespace App\Http\Controllers;

use App\Models\Laboratoire;
use App\Models\Prof;
use App\Models\Doctorant;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'laboratoires' => Laboratoire::count(),
            'profs' => Prof::count(),
            'doctorants' => Doctorant::count()
        ];

        return view('dashboard', compact('stats'));
    }
}
