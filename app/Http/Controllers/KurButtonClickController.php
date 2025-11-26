<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KurButtonClick;
use App\Models\RawButtonClick;

class KurButtonClickController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? KurButtonClick::query() : RawButtonClick::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
