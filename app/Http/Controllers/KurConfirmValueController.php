<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KurConfirmValue;
use App\Models\RawConfirmValue;

class KurConfirmValueController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? KurConfirmValue::query() :RawConfirmValue::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
