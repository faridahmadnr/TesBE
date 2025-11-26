<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KurConfirmResult;
use App\Models\RawConfirmResult;


class KurConfirmResultController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? KurConfirmResult::query() : RawConfirmResult::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
