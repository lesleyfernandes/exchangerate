<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeRateHistory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ExchangeRateController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('exchangerate.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function results()
    {
        $exchangerates = ExchangeRateHistory::orderby('created_at', 'DESC')->get();

        return view('exchangerate.results', compact('exchangerates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Validates the fields birthday and currency
        $exchangeRate = $this->validate(request(), [
            'birthday' => 'date_format:d/m/Y|required|after:-1 year',
            'currency' => 'required'
        ]);

        //Prepares the date field to be manipulated
        $birthday = \DateTime::createFromFormat('d/m/Y', $exchangeRate['birthday']);
        $exchangeRate['birthday'] = $birthday->format('Y-m-d');

        //Connects to the fixer.io API to get the aimed exchange rate
        //Important: GBP is not available in the free plan
        $client = new Client();
        $response = $client->get('http://data.fixer.io/api/' . $exchangeRate['birthday'] . '?access_key=ad7394270ea88a22bda2f29ecf77d90a&base=EUR&symbols=' . $exchangeRate['currency']);
        $data = json_decode($response->getBody());

        //Check the http response status and return an error if not 200 (success)
        if ($response->getStatusCode() != 200) {
            return Redirect::back()->withErrors(['Service Unavailable, please try again later.']);
        }

        $exchangeRate['rate'] = $data->rates->{$exchangeRate['currency']};

        //Checks if a record exists on the database, if not creates a new one.
        $exchange_rate_record = ExchangeRateHistory::firstOrCreate(
            [
                'birthday' => $exchangeRate['birthday'],
                'currency' => $exchangeRate['currency']
            ],
            [
                'birthday' => $exchangeRate['birthday'],
                'currency' => $exchangeRate['currency'],
                'rate' => $exchangeRate['rate'],
                'timeschecked' => 1
            ]
        );

        //if a record was not recently created, the field timeschecked is updated with +1.
        if (!$exchange_rate_record->wasRecentlyCreated) {
            $exchange_rate_record->timeschecked = $exchange_rate_record->timeschecked + 1;
        }

        $exchange_rate_record->save();

        //Redirects to the results page passing parameters to be used in the view.
        return redirect()->route('results')->with(['rate' => $exchangeRate['rate'], 'birthday' => $exchangeRate['birthday'], 'currency' => $exchangeRate['currency']]);
    }

}
