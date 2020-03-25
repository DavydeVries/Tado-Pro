<?php

namespace App\Http\Controllers\Tado;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

class ZonesController extends BaseController
{
    public function index()
    {
        $client = new Client();

        $userRequest = $client->get('https://my.tado.com/api/v2/homes/' . $this->homeId . '/zones', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ]);

        $zones = collect(json_decode($userRequest->getBody()->getContents(), true));

        // TODO: support all types like air conditioning's
        $zones = $zones->filter(function ($value, $key) {
            return data_get($value, 'type') === 'HEATING';
        })->all();

        return response()->json($zones);
    }

    public function get($zoneId)
    {
        $client = new Client();

        $userRequest = $client->get('https://my.tado.com/api/v2/homes/' . $this->homeId . '/zones/' . $zoneId . '/state', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ]);

        $zone = collect(json_decode($userRequest->getBody()->getContents(), true));

        return response()->json($zone);
    }
}
