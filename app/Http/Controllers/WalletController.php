<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.wallet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pay(Request $request)
    {
        $access_token               = "iGsbasuPJXpna3LogpfNL8ooPhjbnC8ghbpxfoWLuJc";
        $amount                     = (float) $request->amount;
        $description                = "Pay test broom";
        $endUserId                  = "9064243594";
        $referenceCode              = "26481000001";
        $transactionOperationStatus = "Charged";
        $duration                   = "0";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://devapi.globelabs.com.ph/payment/v1/transactions/amount?access_token=" . $access_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => "{ \"amount\": \"" . $amount . "\", \"description\": \"" . $description . "\", \"endUserId\": \"" . $endUserId . "\", \"referenceCode\": \"" . $referenceCode . "\", \"transactionOperationStatus\":\"" . $transactionOperationStatus . "\", \"duration\":\"" . $duration . "\" } ",
            CURLOPT_HTTPHEADER     => ["Content-Type: application/json", "Host: devapi.globelabs.com.ph"],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function redirect(Request $request)
    {
        dump($request->input());
    }
}
