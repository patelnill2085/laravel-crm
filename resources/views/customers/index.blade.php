<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Customers
    </h2>
</x-slot>

    <div class="py-6 px-6">
<div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-medium text-gray-700">All Customers</h3>
    <a href="{{ route('customers.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
        + Add Customer
    </a>
</div>
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
                        <th class="px-4 py-3 text-left">Company</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $customer->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $customer->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $customer->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $customer->company ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $customer->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $customer->status === 'inactive' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $customer->status === 'prospect' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('customers.edit', $customer) }}"
                               class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}"
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
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                            No customers found. Add your first customer!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 border-t">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>