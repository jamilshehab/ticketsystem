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
                <img src="{{ asset('storage/' . $ticket->image) }}" 
                     alt="Current  Image" class="h-40 mt-2 rounded">
            </div>

       
            <!-- New Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('New Image (Leave empty to keep current)')" />
                <input type="file" name="image" id="image"
                    class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-white hover:file:bg-slate-700" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
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