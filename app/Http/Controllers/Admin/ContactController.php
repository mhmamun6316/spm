<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contacts.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:contacts.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::select('*')->orderBy('created_at', 'desc');
            
            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('is_read', function ($contact) {
                    return $contact->is_read 
                        ? '<span class="badge bg-success">Read</span>' 
                        : '<span class="badge bg-warning">Unread</span>';
                })
                ->addColumn('created_at', function ($contact) {
                    return $contact->created_at->format('M d, Y h:i A');
                })
                ->addColumn('action', function ($contact) {
                    $viewBtn = '<a href="' . route('admin.contacts.show', $contact->id) . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> View</a>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger" onclick="deleteContact(' . $contact->id . ')"><i class="bi bi-trash"></i> Delete</button>';
                    return $viewBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['is_read', 'action'])
                ->make(true);
        }

        return view('admin.contacts.index');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => 'Contact deleted successfully']);
    }

    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => !$contact->is_read]);

        return response()->json(['success' => 'Status updated successfully']);
    }
}
