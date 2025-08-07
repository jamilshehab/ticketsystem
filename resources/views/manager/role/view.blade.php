<x-app-layout>
    <div class="container px-4 mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">View Users && Assign Roles</h1>
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">firstName</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">lastName</th>
                             <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Submitted On</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                        
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $user->firstName }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{$user->lastName}}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{$user->getRoleNames()->first() }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('M d, Y H:i') }} </td>
                               
                                   <td class="px-6 py-4 text-center space-x-2">
                                   <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative w-fit" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                                    <select  class="select">   
                                     @foreach ($roles as $role)
                                       <option {{$user->roles[0]->id == $role->id ? "selected" : '' }}  value="{{$role->id}}" >{{$role->name}} </option>
                                     @endforeach 
                                     </select>   
                                      <a href="#" class="bg-slate-900 px-3 py-2">Assign</a>
                                  </div>
                                 
                                     {{-- @if ($ticket->status !== 'resolved')
                                  

                                    <form action="{{ route('client.destroy', $ticket->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this?');"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                 @endif --}}
                                </td>  
                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 text-center text-xl mt-8">No Users Found.</p>
        @endif
    </div>
</x-app-layout>