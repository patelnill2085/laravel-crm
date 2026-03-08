<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('assignedTo')
            ->latest()
            ->paginate(10);
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        $users = User::all();
        return view('leads.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:leads',
            'phone'       => 'nullable|string|max:20',
            'source'      => 'nullable|string|max:255',
            'status'      => 'required|in:new,contacted,qualified,lost,converted',
            'notes'       => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
        ]);

        Lead::create($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead added successfully!');
    }

    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        $users = User::all();
        return view('leads.edit', compact('lead', 'users'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:leads,email,' . $lead->id,
            'phone'       => 'nullable|string|max:20',
            'source'      => 'nullable|string|max:255',
            'status'      => 'required|in:new,contacted,qualified,lost,converted',
            'notes'       => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead updated successfully!');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully!');
    }
    public function kanban()
    {
        $leads = Lead::with('assignedTo')->get();
        return view('leads.kanban', compact('leads'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,qualified,lost,converted'
        ]);

        $lead->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}