<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSubmissionRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Store a new contact submission
     */
    public function store(ContactSubmissionRequest $request): JsonResponse
    {
        try {
            ContactSubmission::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Pesan Anda telah terkirim. Kami akan menghubungi Anda segera.',
            ], 201);
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ], 500);
        }
    }
}
