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

        $model = $isEnriched ? KurPageStay::query() :RawPageStay::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}



