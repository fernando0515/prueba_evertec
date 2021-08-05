<?php

namespace App\Http\Controllers;

use App\DTO\PlacetopaySessionData;
use App\Http\Requests\CreatePseSessionRequest;
use App\Services\PseService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PseController extends Controller
{
    public function index(Request $request, PseService $pseService)
    {
        $idForm = Str::random(15);
        $banks = $pseService->getBankList();

        $data = null;

        if($request->has('idForm')){
            $data = $pseService->getTransactionInformation(
                session($request->input('idForm'))
            );
        }

        return view('pse.index', compact('banks', 'idForm', 'data'));
    }

    public function store(CreatePseSessionRequest $request, PseService $pseService)
    {
        $transaction = $pseService->createTransaction(PlacetopaySessionData::makeData($request));

        session([$request->input('idForm') => $transaction->transactionID]);

        return redirect()->away($transaction->bankURL);
    }
}
