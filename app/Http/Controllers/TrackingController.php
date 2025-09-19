<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    /**
     * Menyimpan event baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // 1. Validasi data yang masuk dari frontend
            $validatedData = $request->validate([
                'user_id' => 'nullable|string|max:255',
                'event_name' => 'required|string|max:255',
                'page_name' => 'nullable|string|max:255',
                'ip_address' => 'nullable|string|max:45',
                'event_properties' => 'nullable|array',
            ]);

            // 2. Simpan data ke database menggunakan Model Event.
            // makesure event_properties di decode jadi json string
            $event = Event::create($validatedData);

            // 3. Berikan respons sukses.
            // 201 untuk resource berhasil dibuat.
            return response()->json([
                'message' => 'Event berhasil dicatat',
                'data' => $event,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error jika data tidak valid (misal: event_name kosong).
            Log::error('Validation Error while storing event', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validasi data gagal.',
                'errors' => $e->errors()
            ], 422); // Status 422 Unprocessable Entity

        } catch (\Exception $e) {
            // handle any other error
            Log::error('General Error while storing event', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Terjadi kesalahan pada server. Mohon coba lagi.',
                'error' => $e->getMessage()
            ], 500); // Status 500 Internal Server Error
        }
        
    }
}