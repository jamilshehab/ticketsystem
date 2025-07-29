<x-app-layout>
    <div class="container px-4 mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Submitted Tickets</h1>
 
        @if($tickets->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Content</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Image</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Submitted On</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($tickets as $ticket)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ Str::limit($ticket->title, 4) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ Str::limit($ticket->content, limit: 15) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    @if($ticket->images && $ticket->images->count())
                                    <div class="flex gap-2 flex-wrap">
                                    @foreach($ticket->images as $image)
                                     <img src="{{ asset('storage/' . $image->path) }}" 
                                     alt="Ticket Image" 
                                     class="w-24 h-24 object-cover rounded shadow" />
                                   @endforeach
                                </div>
                            @else
                             —
                             @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                   <span
                                     class="px-2 py-1 rounded text-white text-xs
                                    @if($ticket->status === 'pending') bg-yellow-500
                                    @elseif($ticket->status === 'active') bg-blue-500
                                    @elseif($ticket->status === 'resolved') bg-green-500
                                   @elseif($ticket->status === 'suspended') bg-red-500
                                  @endif">
                                 {{ ucfirst($ticket->status) }}
                               </span> 
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $ticket->created_at->format('M d, Y H:i') }}
                                </td>
                                <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative w-fit" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
    <!-- Toggle Button -->
    <td class="px-6 py-4 text-sm text-center">
    <td class="px-6 py-4 text-sm text-center">
    
     <div class="flex items-center justify-center gap-2">
        <!-- View Button -->
        <a href="{{ route('tickets.show', $ticket->id) }}" 
           class="px-3 py-1 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">
            View
        </a>

      
      @if ($ticket->status !== 'resolved')
         <div x-data="agentFilter(agents:{{$agents}})" class="relative w-full max-w-md">
  <!-- Search Input (triggers dropdown) -->
  <div class="relative">
    <input 
      x-model="searchQuery"
      @focus="open=true"
      class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      placeholder="Search Agents..."
    >
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </div>

  <!-- Dropdown Panel -->
  <div 
    x-show="open"
    @click.away="open = false"
    class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden"
    x-transition
  >
    <!-- Loading State -->
    <template x-if="loading">
      <div class="p-3 text-center text-gray-500">Loading...</div>
    </template>

    <!-- Results -->
    <template x-if="!loading && filteredAgents.length > 0">
      <div class="max-h-60 overflow-y-auto">
        <template x-for="agents in filteredAgents" :key="agents.id">
          <label class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
            {{-- <input 
              type="checkbox" 
              x-model="selectedDepartments" 
              :value="department.id" 
              class="rounded text-blue-600 focus:ring-blue-500"
            > --}}
            <span class="ml-2 text-sm" x-text="`${agents.firstName} (${agents.department.name})`"></span>
          </label>
        </template>
      </div>
    </template>

    <!-- Empty State -->
    <template x-if="!loading && filteredAgents.length === 0">
      <div class="p-3 text-center text-gray-500">No departments found</div>
    </template>
  </div>

  <!-- Selected Items (Pills) -->
  <div x-show="selectedDepartments.length > 0" class="flex flex-wrap gap-2 mt-2">
    <template x-for="id in selectedDepartments" :key="id">
      <div class="flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
        <span x-text="getDepartmentName(id)"></span>
        <button @click="removeDepartment(id)" class="ml-1 text-blue-600 hover:text-blue-800">
          &times;
        </button>
      </div>
    </template>
  </div>
</div>
      @endif
    </div>
</td>
</td>
</div>
   </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $tickets->links() }}
            </div>
        @else
            <p class="text-gray-600 text-center text-xl mt-8">No Tickets Found.</p>
        @endif
    </div>
</x-app-layout>
<script src="{{asset('assets/js/search.js')}}"></script>