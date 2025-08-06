<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white p-8 shadow-xl rounded-lg">
                <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Edit your Ticket Issue</h2>
                
                <form method="POST" action="{{ route('client.update' , $ticket->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Ticket Title')" />
                        <x-text-input id="title" class="block mt-1 w-full px-3 py-2" type="text" name="title" :value="old('title' , $ticket->title)" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Ticket Content')" />
                        <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                  type="text" name="content" rows="4" required autofocus autocomplete="content">{{ old('content', $ticket->content)}}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                     <div class="mt-4">
                <x-input-label :value="__('Current Image')" />
                  <div class="block  flex-wrap rows-1   columns-{{$ticket->images->count() <= 5 ? $ticket->images->count() : 5}}">
                  @foreach($ticket->images as $image)
                  <img src="{{ asset('storage/' . $image->path) }}" 
                  alt="Ticket Image" 
                  class="h-auto aspect-square  insets-2 object-cover rounded shadow flex-1 w-full" />
                  @endforeach
              </div>
                     
            </div>

       
            <!-- New Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('New Image (Leave empty to keep current)')" />
                <input type="file" name="images[]" multiple accept="*/images" id="image"
                    class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-white hover:file:bg-slate-700" />
                <x-input-error :messages="$errors->get('images')" class="mt-2" />
            </div>
                    
                    <div class="flex items-center  mt-6">
                        <x-primary-button >
                            {{ __('Update Your Ticket') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </x-app-layout>