<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        try {

            $validatedData = $request->validate([
                'user_id' => 'nullable|string|max:255',
                'event_name' => 'required|string|max:255',
                'event_properties' => 'required|json',
                'email' => 'nullable|email|max:255',
            ]);

            $validatedData['ip_address'] = $request->ip();
            
            $event = Event::create($validatedData);

            return response()->json([
                'message' => 'Event berhasil dicatat',
                'data' => $event,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error while storing event', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validasi data gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('General Error while storing event', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Terjadi kesalahan pada server. Mohon coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
 
    }
    public function index(Request $request)
    {
        $data = Event::query()->paginate(100);
        
        return response()->json($data);
    }
}