<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        $cUrl = 'https://api.nbp.pl/api/exchangerates/tables/a/?format=json';
        $user_currency_codes = $user->currency;
        $response = Http::GET($cUrl)->json();
        $currency_all = $response[0]['rates'];

        $user_currency = [];
        foreach ($currency_all as $currency)
        {
            if(in_array($currency['code'], $user_currency_codes))
            {
                $user_currency[] = $currency;
            }

        }

        //$currency_all['effectiveDate'] = $response[0]['effectiveDate'];
        return view('currency.show', ['user' => $user, 'currency_all' => $currency_all, 'user_currency' => $user_currency, 'user_currency_codes' => $user_currency_codes]);
    }

    public function update()
    {
        $user = Auth::user();
        request()->validate([
            'currency' => 'array',
            'currency.*' => 'string|min:3|max:3',
        ]);
        if(request()->currency != NULL)
        {
            $user->currency = request()->currency;
        }else $user->currency = [];

        $user->save();

        return redirect()->route('currency.show');
    }

    public function showGold()
    {
        $now = Carbon::now();
        $start = $now->subDays(10)->toDateString();
        $end = $now->toDateString();
        $gUrl = 'http://api.nbp.pl/api/cenyzlota/'. $start .'/'. $end .'/?format=json';
        $response = Http::GET($gUrl)->json();

        return view('currency.showGold', ['gold_price' => $response]);
    }

    public function showOne()
    {
        $cUrl = 'https://api.nbp.pl/api/exchangerates/tables/a/?format=json';
        $response = Http::GET($cUrl)->json();
        $currency_all = $response[0]['rates'];
        $codes = [];
        $single_currency = [];

        foreach ($currency_all as $currency) {
            $codes[] = $currency['code'];
        }

        if (request()->date != NULL) {
            $request = request()->validate([
                'code' => 'string|max:3|min:3',
                'date' => 'date',
            ]);
            
            $single_currency = ['code' => request()->code, 'mid' => 'No available rate from that day', 'effectiveDate' => 'Date'];
            $cUrl = 'http://api.nbp.pl/api/exchangerates/rates/a/'. $request['code'] .'/'. $request['date'] .'/?format=json';

            if($response = Http::GET($cUrl)->json() != NULL) {
                $response = Http::GET($cUrl)->json();
                $single_currency = $response['rates'][0];
                $single_currency['code'] = $request['code'];
            }
        }
        return view('currency.showOne', ['codes' => $codes, 'single_currency' => $single_currency]);
    }
}
