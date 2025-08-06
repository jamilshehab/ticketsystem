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
                                <div  class="relative w-fit" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
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
         <div x-data="agentFilter({{$agents}})" class="relative w-full max-w-md">
  <!-- Search Input (triggers dropdown) -->
  <div class="relative">
    <input 
      @focus="open=true"
      @blur="filterAgents"
      class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      placeholder="Search Agents..."
    >
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </div>
   <div x-show="selectedAgents.length > 0" class="flex flex-wrap gap-2 mt-2">
   <template x-for="agent in selectedAgents">
      <div class="tag-badge inline-flex items-center rounded-md bg-gray-50 px-2 py-3 mx-3 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
        <span x-text="`${agent?.firstName ?? ''} ${agent?.lastName ?? ''} ${agent?.department?.department_name ?? ''}`"></span>
 
        <button class="mx-2 text-lg items-center flex"  @click="removeSelectedAgents(agent.id)">x</button>
      </div>
 </template> 
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

  </div>

  <!-- Selected Items (Pills) -->

  <div x-show="filteredAgents.length > 0" class="flex flex-wrap gap-2 mt-2">
    <template x-for="agent in filteredAgents" :key="agent.id">
      
      <li class="block w-full px-4 py-3 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100 last:border-b-0"    @click="addSelectedAgents(agent.id)" >
    <div class="flex flex-row min-w-0 gap-1">
        <p class="text-base font-semibold text-gray-900 truncate" x-text="`${agent?.firstName ?? ''} ${agent?.lastName ?? ''}`"></p>
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <p class="text-sm text-gray-600" x-text="agent?.department?.department_name ?? ''"></p>
        </div>
    </div>
      </li>
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
 