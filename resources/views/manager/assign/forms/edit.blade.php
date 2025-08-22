<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white p-8 shadow-xl rounded-lg">
                <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Assign The Ticket To Agent</h2>
                
                <form method="POST" action="{{ route('manager.update' , $ticket->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Issue Title')" />
                        <x-text-input id="title" class="block mt-1 w-full px-3 py-2" type="text" name="title" :value="old('title' , $ticket->title)" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Issue Content')" />
                        <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                  type="text" name="content" rows="4" required autofocus autocomplete="content">{{ old('content', $ticket->content)}}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                     <div class="mt-4">
                <x-input-label :value="__('Current Image')" />
                   <div class="block  flex-wrap rows-1 columns-5  columns-{{$ticket->images->count() <= 5 ? $ticket->images->count() : 5}}">
                  @foreach($ticket->images as $image)
                  <img src="{{ asset('storage/' . $image->path) }}" 
                  alt="Ticket Image" 
                  class="h-auto aspect-square  insets-2 object-cover rounded shadow flex-1 w-full" />
                  @endforeach
              </div>
              

       
            <!-- New Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('New Image (Leave empty to keep current)')" />
                <input type="file" name="image" id="image"
                    class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-white hover:file:bg-slate-700" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
              <div class="my-5">
                   <div x-data="agentFilter({{$agents}})" class="relative w-full max-w-md">
  <!-- Search Input (triggers dropdown) -->
          <div class="relative">
            <input 
      @focus="open=true"
      @blur="filterAgents"
      class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      placeholder="Search Head of Departments..."
    >
         <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
          </div>
   
          </div>
           <template x-for="agent in selectedAgents" :key="agent.id">
            <input type="hidden" name="agents[]" :value="agent.id" />
           </template>
 
            
           
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
    <div class="flex flex-row min-w-0 gap-2">
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
              </div> 
                    <div class="flex items-center  mt-6">
                        <x-primary-button >
                            {{ __('Assign Tickets') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
 </x-app-layout>
  <script src="{{asset('assets/js/search.js')}}"></script>