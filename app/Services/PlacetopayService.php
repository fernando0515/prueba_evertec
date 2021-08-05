<?php

namespace App\Services;

use App\DTO\PlacetopaySessionData;
use Dnetix\Redirection\PlacetoPay;

class PlacetopayService
{
    private PlacetoPay $placetoPay;
    //private string $login;

    public function __construct(string $login, string $secretKey, string $baseurl)
    {
        //$this->login = $login;
        $this->placetoPay = new PlacetoPay([
            'login' => $login,
            'tranKey' => $secretKey,
            'url' => $baseurl,
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ],
        ]);
    }

    public function createSession(PlacetopaySessionData $placetopaySessionData)
    {
        $request = [
            'payment' => [
                'reference' => $placetopaySessionData->reference,
                'description' => $placetopaySessionData->description,
                'amount' => [
                    'currency' => $placetopaySessionData->currency,
                    'total' => $placetopaySessionData->amount,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => route('app.index').'?idForm='.$placetopaySessionData->idForm,
            'ipAddress' => $placetopaySessionData->ip,
            'userAgent' => $placetopaySessionData->userAgent,
        ];

        $response = $this->placetoPay->request($request);

        $url = null;
        $message = '';
        $succes = false;
        $sessionId = null;

        if ($response->isSuccessful()) {
            $succes = true;
            $url = $response->processUrl();
            $sessionId = $response->requestId();
        } else {
            $message = $response->status()->message();
        }

        return [
            'success' => $succes,
            'url' => $url,
            'message' => $message,
            'sessionId' => $sessionId,
        ];
    }

    public function fetchSession(string $idSession)
    {
        $sessionInformation = $this->placetoPay->query($idSession);

        return $sessionInformation->toArray();
    }
}
