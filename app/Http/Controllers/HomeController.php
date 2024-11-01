<?php

namespace App\Http\Controllers;
use App\Models\Campaign;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        //return view('campaigns.index', compact('campaigns'));
        return view('welcome', compact('campaigns'));
    }
}
