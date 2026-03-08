<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'total_leads' => Lead::count(),
            'total_users' => User::count(),
            'new_leads' => Lead::where('status', 'new')->count(),
            'active_customers' => Customer::where('status', 'active')->count(),
            'converted_leads' => Lead::where('status', 'converted')->count(),
        ];

        $recent_customers = Customer::with('creator')
            ->latest()
            ->take(5)
            ->get();

        $recent_leads = Lead::with('assignedTo')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_customers', 'recent_leads'));
    }
}