<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Models\Contribution;
use Illuminate\Support\Facades\Crypt;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ContributionController extends Controller
{
    public function index()
    {
        $contributions = Contribution::where('user_id', Auth::id())->with('campaign')->get();
        return view('contributor.contributions', compact('contributions'));
    }

    public function create(Campaign $campaign)
    {
        return view('contributions.create', compact('campaign'));
    }

    // public function store(Request $request, Campaign $campaign)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric|min:0.01',
    //         'paypal_account' => 'required|email',
    //     ]);
        

    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->setAccessToken($provider->getAccessToken());

    //     $response = $provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "purchase_units" => [
    //             [
    //                 "amount" => [
    //                     "currency_code" => "USD",
    //                     "value" => $request->amount
    //                 ],
    //                 "description" => "Contribution to " . $campaign->title,
    //             ]
    //         ],
    //         "application_context" => [
    //             "cancel_url" => route('contributions.cancel', $campaign),
    //             "return_url" => route('contributions.success', $campaign),
    //         ]
    //     ]);

    //     if (isset($response['id'])) {
    //         foreach ($response['links'] as $link) {
    //             if ($link['rel'] === 'approve') {
    //                 return redirect()->away($link['href']);
    //             }
    //         }
    //     }

    //     return redirect()->route('campaigns.show', $campaign)->with('error', 'Something went wrong.');
    // }

//     public function store(Request $request, Campaign $campaign)
// {
//     $request->validate([
//         'amount' => 'required|numeric|min:0.01',
//         'paypal_account' => 'required|email',
//     ]);

   
//     Contribution::create([
//         'user_id' => Auth::id(),
//         'campaign_id' => $campaign->id,
//         'amount' => $request->amount,
//         'paypal_account' => Crypt::encryptString($request->input('paypal_account')),
//     ]);

    
//     $campaign->current_amount += $request->amount;
//     $campaign->save();

//     return redirect()->route('contributor.contributions')->with('success', 'Contribution made successfully.');
// }


    // public function success(Request $request, Campaign $campaign)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->setAccessToken($provider->getAccessToken());

    //     $response = $provider->capturePaymentOrder($request['token']);

    //     if ($response['status'] === 'COMPLETED') {
    //         Contribution::create([
    //             'user_id' => Auth::id(),
    //             'campaign_id' => $campaign->id,
    //             'amount' => $response['purchase_units'][0]['amount']['value'],
    //             'paypal_account' => Crypt::encryptString($request->input('paypal_account')),
    //         ]);

    //         return redirect()->route('contributor.contributions')->with('success', 'Contribution made successfully.');
    //     }

    //     return redirect()->route('campaigns.show', $campaign)->with('error', 'Payment failed.');
    // }

    // public function cancel(Campaign $campaign)
    // {
    //     return redirect()->route('campaigns.show', $campaign)->with('error', 'You have canceled the payment.');
    // }
    
    // public function captureOrder(Request $request, Campaign $campaign)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->setAccessToken($provider->getAccessToken());

    //     $response = $provider->capturePaymentOrder($request->input('token'));

    //     if (isset($response['status']) && $response['status'] == 'COMPLETED') {
    //         Contribution::create([
    //             'user_id' => Auth::id(),
    //             'campaign_id' => $campaign->id,
    //             'amount' => $response['purchase_units'][0]['amount']['value'],
    //         ]);

    //         return redirect()->route('contributor.contributions')->with('success', 'Contribution made successfully.');
    //     }

    //     return redirect()->route('contributions.create', $campaign)->with('error', 'Payment failed.');
    // }

    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());
        //$provider->getAccessToken();

        

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ],
                    "description" => "Contribution to " . $campaign->title,
                ]
            ],
            "application_context" => [
                "cancel_url" => route('contributions.create', $campaign),
                "return_url" => route('contributions.success', $campaign),
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('contributions.create', $campaign)->with('error', 'Something went wrong.');
    }

    public function success(Request $request, Campaign $campaign)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            Contribution::create([
                'user_id' => Auth::id(),
                'campaign_id' => $campaign->id,
                'amount' => $response['purchase_units'][0]['amount']['value'],
            ]);

            return redirect()->route('contributor.contributions')->with('success', 'Contribution made successfully.');
        }

        return redirect()->route('contributions.create', $campaign)->with('error', 'Payment failed.');
    }
}
