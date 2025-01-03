<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function __invoke(Request $request, Download $download)
    {
        abort_if($request->ajax(), 403);

        // return $download->download();
    }
}
