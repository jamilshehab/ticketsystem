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
                               
                                   <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('client.show', $ticket->id) }}" 
                                     class="inline-block px-3 py-1 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">
                                       View
                                       </a>
                                    @if ($ticket->status !== 'pending')
                                    <a href="{{ route('client.edit', $ticket->id) }}" 
                                       class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('client.destroy', $ticket->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this?');"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                 @endif
                                </td>  
                              
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