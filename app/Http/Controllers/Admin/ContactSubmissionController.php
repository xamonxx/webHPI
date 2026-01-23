<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of messages
     */
    public function index(): View
    {
        $messages = ContactSubmission::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified message
     */
    public function show(ContactSubmission $message): View
    {
        // Mark as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Remove the specified message
     */
    public function destroy(ContactSubmission $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
