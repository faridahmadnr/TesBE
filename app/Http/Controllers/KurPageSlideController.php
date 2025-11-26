<?php

namespace App\Http\Controllers;

use App\Models\KurPageSlide;
use Illuminate\Http\Request;
use illuminate\Support\Facades\DB;
use App\Models\RawPageSlide;

class KurPageSlideController extends Controller
{
    public function index(Request $request)
    {
        $isEnriched = $request -> query('enriched') == 'true';

        $model = $isEnriched ? KurPageSlide::query() :RawPageSlide::query();

        $data = $model -> paginate(100);
        
        return response()->json($data);
    }
}
