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

            <!-- Images -->
                 @if($ticket->image)
                        <div class="mt-4">
                        <img src="{{ asset('storage/' . $ticket->image) }}" class="w-full h-72 object-cover rounded shadow" alt="Ticket Image">
                        </div>
                @endif

            <!-- Metadata -->
            <div class="mt-6 text-sm text-gray-500 border-t pt-4">
                <p>Submitted by: <strong>{{ $ticket->user->firstName . ' ' . $ticket->user->lastName ?? 'Unknown User' }}</strong></p>
                <p>On: {{ $ticket->created_at->format('M d, Y H:i') }}</p>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex space-x-4">
                
               @if($ticket->status!=='resolved')
                <a href="{{ route('client.edit', $ticket->id) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Edit
                </a>

                <form action="{{ route('client.destroy', $ticket->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </form>
               @endif

                <a href="{{ route('client.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Back to All Tickets
                </a>
            </div>

        </div>
    </div>
</x-app-layout>