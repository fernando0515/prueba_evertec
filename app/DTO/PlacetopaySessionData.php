<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class PlacetopaySessionData extends DataTransferObject
{
    public string $reference;
    public string $currency;
    public float $amount;
    public string $description;
    public string $idForm;
    public string $ip;
    public string $userAgent;

    public ?string $bank;
    public ?string $person;
    public ?string $document;
    public ?string $documentType;
    public ?string $name;
    public ?string $surname;
    public ?string $email;



    public static function makeData(FormRequest $request)
    {
        return new self([
            'reference' => Str::random(10),
            'currency' => $request->input('currency'),
            'amount' => (float) $request->input('amount'),
            'description' => $request->input('description', ''),
            'idForm' => $request->input('idForm'),
            'ip' => $request->ip(),
            'userAgent' => $request->userAgent(),
            'bank' => $request->input('bank'),
            'person' => $request->input('person'),
            'document' => $request->input('document'),
            'documentType' => $request->input('documentType'),
            'name' => $request->input('name'),
            'surname' => $request-> input('surname'),
            'email' => $request->input('email'),
        ]);
    }
}
