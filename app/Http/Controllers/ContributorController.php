<?php


namespace App\Http\Controllers;
use App\Models\Campaign;
use App\Models\Contribution;

use Illuminate\Http\Request;

class ContributorController extends Controller
{
    public function index(){

        $latestCampaigns = Campaign::orderBy('created_at', 'desc')->take(10)->get();


        return view('contributor.dashboard', compact('latestCampaigns'));
    }
    public function myContributions()
    {
        
        $userId = auth()->id(); 
        $contibutions = Contribution::where('user_id', $userId)->get(); 
        return view('contributor.contributions', compact('contibutions'));
    }
}
