<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            //Validate data yang masuk dari frontend (ini masi sementara, buat nyoba dl)
            $validatedData = $request->validate([
                'user_id' => 'nullable|string|max:255',
                'event_name' => 'required|string|max:255',
                'ip_address' => 'nullable|ip',
                'event_properties' => 'nullable|json',
            ]);

            $enrichmentData = [];


            //Simpan data ke database pake Model Event yg udh dibuat
            //makesure event_properties diubah jd array dl, !!implementasi realnya pake jsnon!!
            $event = Event::create($validatedData);

            //201 untuk resource berhasil dibuat ^^
            return response()->json([
                'message' => 'Event berhasil dicatat',
                'data' => $event,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            //kl misal data ga valid
            Log::error('Validation Error while storing event', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validasi data gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // handle any other error
            Log::error('General Error while storing event', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Terjadi kesalahan pada server. Mohon coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }


        
    }

}