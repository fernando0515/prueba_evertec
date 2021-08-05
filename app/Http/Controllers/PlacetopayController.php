<?php

namespace App\Http\Controllers;

use App\DTO\PlacetopaySessionData;
use App\Http\Requests\CreateSessionRequest;
use App\Services\PlacetopayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacetopayController extends Controller
{
    public function index(Request $request, PlacetopayService $placetopayService)
    {
        $idForm = Str::random(15);

        $data = null;

        if ($request->has('idForm')) {
            $data = $placetopayService->fetchSession(
                 session($request->input('idForm'))
            );
        }

        return view('placetopay.index', compact('idForm', 'data'));
    }

    public function store(CreateSessionRequest $request, PlacetopayService $placetopay)
    {
        $session = $placetopay->createSession(PlacetopaySessionData::makeData($request));

        session([$request->input('idForm') => $session['sessionId']]);

        return redirect()->away($session['url']);
    }
}
