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
      <div x-data="{ type: 'department' }" class="flex items-center justify-center gap-4">
 <!-- Radio Buttons -->
      <div class="flex flex-wrap gap-4">
        <div class="flex items-center">
            <input id="radio-department" type="radio" value="department" x-model="type" name="assign_type"
                class="w-4 h-4 text-slate-900 bg-gray-100 border-gray-300 focus:ring-slate-900">
            <label for="radio-department"
                class="ml-2 text-sm font-medium text-gray-900">Department</label>
        </div>
        <div class="flex items-center">
            <input id="radio-user" type="radio" value="user" x-model="type" name="assign_type"
                class="w-4 h-4 text-slate-900 bg-gray-100 border-gray-300 focus:ring-slate-900">
            <label for="radio-user"
                class="ml-2 text-sm font-medium text-gray-900">Users</label>
        </div>
    </div>

    <!-- Dropdown -->
    <div class="relative">
        <!-- Department Dropdown -->
         
           <div x-data="{ isOpen: false }" x-show="type === 'department'" class="relative w-fit">
        <button @click="isOpen = !isOpen" class="inline-flex items-center gap-2 rounded border border-gray-300 bg-white px-4 py-2  w-full text-sm hover:bg-gray-100">
            Assign Roles To Departments
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div x-show="isOpen" @click.outside="isOpen=false" class="absolute z-10 py-2 bg-white border border-gray-200 rounded shadow w-full">
            @foreach($departments as $department)
                <form method="POST" action="{{ route('tickets.assign', $ticket->id) }}">
                    @csrf
                    <input type="hidden" name="department_id" value="{{ $department->id }}">
                    <button type="submit" class="block w-full text-left px-2 my-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{$department->department_name}}
                </form>
            @endforeach
        </div>
       </div>
        
           
        <div x-data="{ isOpen: false }" x-show="type === 'user'" class="relative w-fit">
        <button @click="isOpen = !isOpen" class="inline-flex items-center gap-2 rounded border border-gray-300 bg-white px-4 py-2  w-full text-sm hover:bg-gray-100">
            Assign Roles To Agents
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div x-show="isOpen" @click.outside="isOpen=false" class="absolute z-10 py-2 bg-white border w-full border-gray-200 rounded shadow">
            @foreach($agents as $agent)
                <form method="POST" action="{{ route('tickets.assign', $ticket->id) }}">
                    @csrf
                    <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                    <button type="submit" class="block w-full text-left px-2 my-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ $agent->firstName }}  {{$agent->lastName}}
                </form>
            @endforeach
        </div>
       </div>

       
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