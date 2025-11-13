<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KurPageStay;
use App\Models\RawPageStay;

class KurPageStayController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? \App\Models\KurPageStay::query() : \App\Models\RawPageStay::query();

        $data = $model -> paginate(20);
        
        return response()->json($data);
    }
}



