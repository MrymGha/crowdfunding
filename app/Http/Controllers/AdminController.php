<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $latestCampaigns = Campaign::orderBy('created_at', 'desc')->take(10)->get();


        return view('admin.dashboard', compact('latestCampaigns'));
    }

    public function manageCampaigns()
    {
        $campaigns = Campaign::all();
        return view('admin.manage-campaigns', compact('campaigns'));
    }

    
    public function deleteCampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('admin.manage-campaigns')->with('success', 'Campaign deleted successfully.');
    }
    public function manageUsers()
    {
        $users = User::whereIn('role', ['project_owner', 'contributor'])->get();
        return view('admin.manage-users', compact('users'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage-users')->with('success', 'User deleted successfully.');
    }

}
