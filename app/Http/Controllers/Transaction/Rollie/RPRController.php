<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RPRController extends Controller
{
    public function exportBar(Request $request)
    {
        dd($request->all());
    }
}
