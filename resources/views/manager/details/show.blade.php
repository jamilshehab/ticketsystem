 <x-app-layout>
   
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-md">

            <!-- Title & Status -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $ticket->title }}</h1>
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
            </div>

            <!-- Content -->
            <div class="mb-6">
                <p class="text-gray-700 whitespace-pre-line">{{ $ticket->content }}</p>
            </div>

               <div class="block  flex-wrap rows-1  columns-{{$ticket->images->count() <= 5 ? $ticket->images->count() : 5}}">
                  @foreach($ticket->images as $image)
                  <img src="{{ asset('storage/' . $image->path) }}" 
                  alt="Ticket Image" 
                  class="h-auto aspect-square  insets-2 object-cover rounded shadow flex-1 w-full" />
                  @endforeach
              </div>

            <!-- Metadata -->
            <div class="mt-6 text-sm text-gray-500 border-t pt-4">
                <p>Submitted by: <strong>{{ $ticket->user->firstName . ' ' . $ticket->user->lastName ?? 'Unknown User' }}</strong></p>
                <p>On: {{ $ticket->created_at->format('M d, Y H:i') }}</p>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex space-x-4">
     
                <a href="{{ route(name: 'manager.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Back to All Tickets
                </a>
                @if ($ticket->status !== 'resolved')

                 <div x-data="{ isOpen: false }" class="relative w-fit">
            <button @click="isOpen = !isOpen" 
                    class="inline-flex items-center gap-2 rounded border border-gray-300 bg-white px-3 py-1 text-sm hover:bg-gray-100">
                Assign
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

           
                 </div>
                 @endif
            </div>

        </div>
    </div>
</x-app-layout>  
