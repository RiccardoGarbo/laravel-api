<?php

namespace App\Http\Controllers\Guest;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
    $projects = Project::all();
    return view('guest.home', compact('projects'));
    }
}
