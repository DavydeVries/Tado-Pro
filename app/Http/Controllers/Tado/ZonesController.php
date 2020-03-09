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

        $userRequest = $client->get('https://my.tado.com/api/v2/homes/'.$this->homeId.'/zones', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ]);

        dump($userRequest->getBody()->getContents());
    }
}
