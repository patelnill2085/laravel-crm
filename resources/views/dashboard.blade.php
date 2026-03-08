<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            CRM Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $stats['total_customers'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Total Customers</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $stats['active_customers'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Active Customers</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-purple-600">{{ $stats['total_leads'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Total Leads</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-yellow-600">{{ $stats['new_leads'] }}</div>
                <div class="text-sm text-gray-500 mt-1">New Leads</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-red-600">{{ $stats['converted_leads'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Converted</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-3xl font-bold text-gray-600">{{ $stats['total_users'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Total Users</div>
            </div>
        </div>

        <!-- Recent Tables -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Recent Customers -->
            <div class="bg-white rounded-lg shadow">
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="font-semibold text-gray-700">Recent Customers</h3>
                    <a href="{{ route('customers.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                </div>
                <div class="p-4">
                    @forelse($recent_customers as $customer)
                    <div class="flex justify-between items-center py-2 border-b last:border-0">
                        <div>
                            <div class="font-medium text-gray-800">{{ $customer->name }}</div>
                            <div class="text-sm text-gray-500">{{ $customer->email }}</div>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $customer->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $customer->status === 'inactive' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $customer->status === 'prospect' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-400 text-sm text-center py-4">No customers yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Leads -->
            <div class="bg-white rounded-lg shadow">
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="font-semibold text-gray-700">Recent Leads</h3>
                    <a href="{{ route('leads.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                </div>
                <div class="p-4">
                    @forelse($recent_leads as $lead)
                    <div class="flex justify-between items-center py-2 border-b last:border-0">
                        <div>
                            <div class="font-medium text-gray-800">{{ $lead->name }}</div>
                            <div class="text-sm text-gray-500">{{ $lead->email }}</div>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $lead->status === 'contacted' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $lead->status === 'qualified' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $lead->status === 'lost' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $lead->status === 'converted' ? 'bg-purple-100 text-purple-700' : '' }}">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-400 text-sm text-center py-4">No leads yet</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>