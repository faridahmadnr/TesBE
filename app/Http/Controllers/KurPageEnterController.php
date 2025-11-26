<?php

namespace App\Http\Controllers;
use App\Models\KurPageEnter;
use Illuminate\Support\Facades\DB;
use App\Models\RawPageEnter;

use Illuminate\Http\Request;

class KurPageEnterController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ?KurPageEnter::query() :RawPageEnter::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
