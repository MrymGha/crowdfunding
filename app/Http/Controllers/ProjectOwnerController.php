<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class ProjectOwnerController extends Controller
{
    public function index(){

        $latestCampaigns = Campaign::orderBy('created_at', 'desc')->take(10)->get();
        return view('project_owner.dashboard', compact('latestCampaigns'));
    }

    public function myCampaigns()
    {
        
        $userId = auth()->id(); 
        $campaigns = Campaign::where('user_id', $userId)->get(); 
        return view('project_owner.my-campaigns', compact('campaigns'));
    
    }

    public function createCampaign()
    {
        return view('project_owner.create-campaign');
    }

    public function storeCampaign(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paypal_account' => 'required|email',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images', 'public');
        }

        $campaign = new Campaign();
        $campaign->title = $request->input('title');
        $campaign->description = $request->input('description');
        $campaign->goal_amount = $request->input('goal_amount');
        $campaign->photo = $photoPath;
        $campaign->paypal_account = Crypt::encryptString($request->input('paypal_account'));
        $campaign->user_id = Auth::id();
        $campaign->save();

        return redirect()->route('project_owner.my-campaigns');
    }

    public function editCampaign($id)
    {
        $campaign = Campaign::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $campaign->paypal_account = Crypt::decryptString($campaign->paypal_account);
        return view('project_owner.edit-campaign', compact('campaign'));
    }

    public function updateCampaign(Request $request, $id)
    {
        $campaign = Campaign::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paypal_account' => 'required|string',
        ]);

        $data = $request->only(['title', 'description', 'goal_amount']);
        if ($request->hasFile('photo')) {
            if ($campaign->photo) {
                Storage::delete('public/' . $campaign->photo);
            }

       
            $data['photo'] = $request->file('photo')->store('campaign_photos', 'public');
        }

    
        $data['paypal_account'] = Crypt::encrypt($request->paypal_account);

        $campaign->update($data);

        return redirect()->route('project_owner.my-campaigns')->with('success', 'Campaign updated successfully.');
    }

    public function deleteCampaign($id)
    {
        $campaign = Campaign::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $campaign->delete();
        return redirect()->route('project_owner.my-campaigns')->with('success', 'Campaign deleted successfully.');
    }
}
