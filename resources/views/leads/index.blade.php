<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leads
            </h2>
            <a href="{{ route('leads.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                + Add Lead
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-left">Source</th>
                        <th class="px-4 py-3 text-left">Assigned To</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($leads as $lead)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $lead->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $lead->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $lead->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $lead->source ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $lead->assignedTo->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $lead->status === 'contacted' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $lead->status === 'qualified' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $lead->status === 'lost' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $lead->status === 'converted' ? 'bg-purple-100 text-purple-700' : '' }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('leads.edit', $lead) }}"
                               class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('leads.destroy', $lead) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                            No leads found. Add your first lead!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 border-t">
                {{ $leads->links() }}
            </div>
        </div>
    </div>
</x-app-layout>