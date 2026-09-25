<?php

namespace App\Http\Controllers\Admin\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        $total_messages  = ContactMessage::count();
        $unread_messages = ContactMessage::where('is_read', false)->count();

        return view('admin.contact-messages.index', compact('messages', 'total_messages', 'unread_messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return view('admin.contact-messages.show', ['message' => $contactMessage]);
    }

    public function destroy(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الرسالة بنجاح.',
            ]);
        }

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'تم حذف الرسالة بنجاح.');
    }

    public function markRead(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
