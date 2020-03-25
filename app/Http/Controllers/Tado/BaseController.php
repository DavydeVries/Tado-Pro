<?php

namespace App\Http\Controllers\Tado;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    protected $accessToken;
    protected $homeId;
    protected $user;

    public function __construct()
    {
        if (Cache::get('tado.auth')) {
            $this->accessToken = Cache::get('tado.auth')->get('access_token');
        } else {
            $this->auth();
        }

        if ($this->accessToken) {
            if (Cache::get('tado.user')) {
                $this->user = Cache::get('tado.user');
                $this->homeId = Cache::get('tado.user')->get('homeId');
            } else {
                $this->setUser();
            }
        }
    }

    private function auth()
    {
        try {
            $client = new Client();

            $authRequest = $client->post('https://auth.tado.com/oauth/token', [
                'form_params' => [
                    'client_id' => 'tado-web-app',
                    'grant_type' => 'password',
                    'scope' => 'home.user',
                    'username' => config('tado.email'),
                    'password' => config('tado.password'),
                    'client_secret' => 'wZaRN7rpjn3FoNyF5IFuxg9uMzYJcvOoQ8QWiIqS3hfk6gLhVlG57j5YNoZL2Rtc',
                ],
            ]);

            if ($authRequest->getStatusCode() == 200) {
                $response = collect(json_decode((string)$authRequest->getBody(), true));

                $this->accessToken = $response->get('access_token');
                Cache::put('tado.auth', $response, now()->addSeconds($response->get('expires_in')));
            }
        } catch (\Exception $exception) {
        }
    }

    private function setUser()
    {
        $client = new Client();

        $userRequest = $client->get('https://my.tado.com/api/v1/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ]);

        if ($userRequest->getStatusCode() == 200) {
            $response = collect(json_decode((string)$userRequest->getBody(), true));

            $this->user = $response;
            $this->homeId = $response->get('homeId');
            Cache::put('tado.user', $response, 60);

        } else {
            new \Exception();
        }
    }

    public function setupCheck(Request $request)
    {
        if (!config('tado.email') || !config('tado.password')) {
            return $this->jsonAbort(400, 'env file incorrect.');
        }

        if (!$this->accessToken) {
            return $this->jsonAbort(401, 'No access token, invalid credentials?');
        }

//        if ()
//        dump($this->accessToken);

//        if (!config('tado.email') || !config('tado.password')) {
//            abort('401', '');
//        }

        return response()->json(['unit' => config('tado.unit')]);
    }
}
