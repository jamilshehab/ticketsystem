<x-app-layout>
    <div class="container px-4 mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">View Users && Assign Roles</h1>
        @if($users->count() > 0  )
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                             <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">firstName</th>
                             <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">lastName</th>
                             <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>  
                             <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Department</th>
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
                                  @if($user->getRoleNames()->first() === 'agent')
                                   <td class="px-6 py-4 text-sm text-gray-800">{{$user->department->department_name }}</td>
                                  @else
                                   <td class="px-6 py-4 text-sm text-gray-800">No Departments Found</td>
                                  @endif
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('M d, Y H:i') }} </td>
                               
                                   <td class="px-6 py-4 text-center space-x-2">
                                   <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative w-fit" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                                   <form action="{{ route('manager.update', $user->id) }}" method="POST">
                                    @csrf 
                                    <select  class="select" name="assign_role">   
                                     @foreach ($roles as $role)
                                       <option {{$user->roles[0]->id == $role->id ? "selected" : '' }}  value="{{$role->id}}" >{{$role->name}} </option>
                                     @endforeach 
                                     </select>   
                                     @if($user->getRoleNames()->first() === 'agent')
                                     <select name="select_departments" class="select">   
                                     @foreach ($departments as $department)
                                    <option {{$department->id == $user->department_id ? "selected" : '' }}  value="{{$department->id}}" >{{$department->department_name}}  
                                     @endforeach 
                                     </select>
                                     @else
                                      @endif
                                        
                                      <button type="submit" class="bg-slate-900 rounded-xl text-white hover:bg-slate-800 px-3 py-2">Assign</button>
                                   </form>
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