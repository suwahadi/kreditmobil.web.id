<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'car_type_id' => 'required|exists:car_types,id',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'down_payment_amount' => 'required|integer|min:0',
                'tenor_months' => 'required|integer|min:12|max:60',
            ]);

            $lead = Lead::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Data Anda telah kami terima. Tim kami akan segera menghubungi Anda.',
                'lead' => $lead,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Mohon periksa kembali data Anda.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ], 500);
        }
    }

    public function testDrive(Request $request)
    {
        try {
            $validated = $request->validate([
                'car_type_id' => 'required|exists:car_types,id',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'preferred_date' => 'required|date|after:today',
                'preferred_time' => 'required|string|max:50',
                'message' => 'nullable|string|max:1000',
            ]);

            // Create lead with test drive information
            $lead = Lead::create(array_merge($validated, [
                'status' => 'New',
                'down_payment_amount' => 0,
                'tenor_months' => 12,
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Permintaan test drive Anda telah kami terima. Tim kami akan menghubungi Anda untuk konfirmasi.',
                'lead' => $lead,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Mohon periksa kembali data Anda.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ], 500);
        }
    }
}
