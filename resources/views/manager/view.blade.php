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
            <div class="w-full max-w-md">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Select Options</label>
            
            <!-- Multi-select container -->
            <div class="relative">
                <!-- Selected options display -->
                <div class="flex flex-wrap gap-2 p-2 border border-gray-300 rounded-lg bg-white min-h-12">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Option 1
                        <button type="button" class="ml-1.5 inline-flex text-blue-400 hover:text-blue-600 focus:outline-none">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Option 3
                        <button type="button" class="ml-1.5 inline-flex text-blue-400 hover:text-blue-600 focus:outline-none">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                    <input type="text" placeholder="Search options..." class="flex-1 min-w-0 outline-none text-sm px-1 py-1">
                </div>
                
                <!-- Dropdown options -->
                <div class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md py-1 border border-gray-200 max-h-60 overflow-auto">
                    <div class="px-3 py-2 text-xs text-gray-500 uppercase font-medium">Options</div>
                    
                    @foreach ($departments as $department )
                    <div class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center">
                         <label for="option5" class="ml-2 text-sm text-gray-700">{{$department->name}}</label>
                    </div>
                    @endforeach
                     
                    <div class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center">
                         <label for="option5" class="ml-2 text-sm text-gray-700">Option 5</label>
                    </div>
                     
                </div>
            </div>
            
            <p class="text-xs text-gray-500 mt-1">Select one or more options from the list</p>
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