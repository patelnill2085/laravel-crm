<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leads Kanban Board
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('leads.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-600">
                    List View
                </a>
                <a href="{{ route('leads.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    + Add Lead
                </a>
            </div>
        </div>
    </x-slot>

    <!-- jQuery UI for drag & drop -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <div class="py-6 px-6">

        <!-- Stats Bar -->
        <div class="grid grid-cols-5 gap-3 mb-6">
            @foreach(['new' => ['label' => 'New', 'color' => 'blue'], 'contacted' => ['label' => 'Contacted', 'color' => 'yellow'], 'qualified' => ['label' => 'Qualified', 'color' => 'green'], 'lost' => ['label' => 'Lost', 'color' => 'red'], 'converted' => ['label' => 'Converted', 'color' => 'purple']] as $status => $info)
            <div class="bg-white rounded-lg shadow p-3 text-center">
                <div class="text-2xl font-bold text-{{ $info['color'] }}-600">
                    {{ $leads->where('status', $status)->count() }}
                </div>
                <div class="text-xs text-gray-500">{{ $info['label'] }}</div>
            </div>
            @endforeach
        </div>

        <!-- Kanban Board -->
        <div class="flex gap-4 overflow-x-auto pb-4">

            @foreach([
                'new' => ['label' => '🆕 New', 'color' => 'blue'],
                'contacted' => ['label' => '📞 Contacted', 'color' => 'yellow'],
                'qualified' => ['label' => '✅ Qualified', 'color' => 'green'],
                'lost' => ['label' => '❌ Lost', 'color' => 'red'],
                'converted' => ['label' => '🏆 Converted', 'color' => 'purple']
            ] as $status => $info)

            <div class="flex-shrink-0 w-64">
                <!-- Column Header -->
                <div class="bg-{{ $info['color'] }}-100 rounded-t-lg px-4 py-3 flex justify-between items-center">
                    <span class="font-semibold text-{{ $info['color'] }}-800 text-sm">{{ $info['label'] }}</span>
                    <span class="bg-{{ $info['color'] }}-200 text-{{ $info['color'] }}-800 text-xs px-2 py-1 rounded-full">
                        {{ $leads->where('status', $status)->count() }}
                    </span>
                </div>

                <!-- Droppable Column -->
                <div class="kanban-column bg-gray-50 rounded-b-lg min-h-96 p-2 space-y-2"
                     data-status="{{ $status }}">

                    @foreach($leads->where('status', $status) as $lead)
                    <!-- Draggable Card -->
                    <div class="kanban-card bg-white rounded-lg shadow-sm p-3 cursor-grab border border-gray-100 hover:shadow-md transition-shadow"
                         data-id="{{ $lead->id }}">

                        <div class="font-medium text-gray-800 text-sm mb-1">{{ $lead->name }}</div>
                        <div class="text-xs text-gray-500 mb-2">{{ $lead->email }}</div>

                        @if($lead->phone)
                        <div class="text-xs text-gray-500 mb-2">📱 {{ $lead->phone }}</div>
                        @endif

                        @if($lead->source)
                        <div class="text-xs text-gray-400 mb-2">🔗 {{ $lead->source }}</div>
                        @endif

                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-100">
                            <span class="text-xs text-gray-400">{{ $lead->assignedTo->name ?? 'Unassigned' }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('leads.edit', $lead) }}"
                                   class="text-xs text-blue-600 hover:underline">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            @endforeach

        </div>
    </div>

    <script>
    $(document).ready(function() {

        // Make cards draggable
        $(".kanban-card").draggable({
            revert: "invalid",
            helper: "clone",
            opacity: 0.8,
            zIndex: 100,
            start: function() {
                $(this).addClass('opacity-50');
            },
            stop: function() {
                $(this).removeClass('opacity-50');
            }
        });

        // Make columns droppable
        $(".kanban-column").droppable({
            accept: ".kanban-card",
            hoverClass: "bg-blue-50",
            drop: function(event, ui) {
                var leadId = ui.draggable.data('id');
                var newStatus = $(this).data('status');
                var column = $(this);

                // AJAX call to update status
                $.ajax({
                    url: '/leads/' + leadId + '/status',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        // Move card to new column
                        ui.draggable.detach().appendTo(column);
                        ui.draggable.css({top: 0, left: 0});

                        // Update counts
                        location.reload();
                    },
                    error: function() {
                        alert('Error updating status!');
                    }
                });
            }
        });
    });
    </script>

</x-app-layout>