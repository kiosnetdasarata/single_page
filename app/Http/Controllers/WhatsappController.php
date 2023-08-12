<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'no_tlpn' => 'required',
        ]);

        $validateData = Http::asForm()->post('http://103.184.19.7:2200/send-message', [
            'number' => $request->no_tlpn,
            'message' => 'hallo',
        ]);

        // @dd($validateData);
        return response()->json($validateData);
    }
}
