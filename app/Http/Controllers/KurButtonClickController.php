<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurButtonClickController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? \App\Models\KurButtonClick::query() : \App\Models\RawButtonClick::query();

        $data = $model -> paginate(20);
        
        return response()->json($data);
    }
}
