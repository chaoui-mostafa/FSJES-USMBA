<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Laboratoire;
use App\Models\Prof;
use App\Models\Doctorant;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'laboratoires' => Laboratoire::count(),
            'profs' => Prof::count(),
            'doctorants' => Doctorant::count(),
            'users' => User::count() // Add this line
            



        ];

        return view('dashboard', compact('stats'));
    }
}
