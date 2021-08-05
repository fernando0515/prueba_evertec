<?php
namespace App\Services;

use App\DTO\PlacetopaySessionData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SoapClient;

class PseService
{
    private SoapClient $client;
    private array $auth;

    public function __construct(string $login, string $secretKey, string $baseurl)
    {
        $this->client = new SoapClient($baseurl, ['trace' => 1, 'exception' => 1]);

        $seed = Carbon::now()->format('c');

        $this->auth = [
            'login' => $login,
            'tranKey' => sha1($seed . $secretKey),
            'seed' => $seed,
        ];
    }


    public function getBankList()
    {
        if(Cache::has('bankList')){
            return Cache::get('bankList');
        }

        $banks = $this->client->getBankList([
            'auth' => $this->auth,
        ])->getBankListResult->item;

        Cache::put('bankList', $banks, now()->addDay());

        return $banks;
    }

    public function createTransaction(PlacetopaySessionData $placetopaySessionData)
    {
            return $this->client->createTransaction([
                'auth' => $this->auth,
                'transaction' => [
                    'bankCode' => $placetopaySessionData->bank,
                    'bankInterface' => $placetopaySessionData->person,
                    'returnURL' => route('app.pse') . '?idForm=' . $placetopaySessionData->idForm,
                    'reference' => $placetopaySessionData->reference,
                    'description' => $placetopaySessionData->description,
                    'currency' => $placetopaySessionData->currency,
                    'totalAmount' => $placetopaySessionData->amount,
                    'ipAddress' => $placetopaySessionData->ip,
                    'userAgent' => $placetopaySessionData->userAgent,
                    'payer' => [
                        'documentType' => $placetopaySessionData->documentType,
                        'document' => $placetopaySessionData->document,
                        'firstName' => $placetopaySessionData->name,
                        'emailAddress' => $placetopaySessionData->email,
                        'lastName' => $placetopaySessionData->surname,
                    ],
                ]
            ])->createTransactionResult;
    }

    public function getTransactionInformation($transactionID)
    {
        return $this->client->getTransactionInformation([
            'auth' => $this->auth,
            'transactionID' => $transactionID,
        ])
            ->getTransactionInformationResult;
    }

}





