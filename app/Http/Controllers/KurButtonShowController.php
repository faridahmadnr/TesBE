<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KurButtonShow;
use App\Models\RawButtonShow;

class KurButtonShowController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? KurButtonShow::query() : RawButtonShow::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
