<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white p-8 shadow-xl rounded-lg">
                <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Submit A New Ticket Issue</h2>
                
                <form method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Ticket Title')" />
                        <x-text-input id="title" class="block mt-1 w-full px-3 py-2" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Ticket Content')" />
                        <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                  type="text" name="content" rows="4" required autofocus autocomplete="content">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    {{-- <div class="mt-4">
                        <x-input-label for="image" :value="__('Ticket Image')" />
                        <input type="file"
                            id="image"
                            name="image"
                            class="w-full text-slate-500 font-medium text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-gray-800 file:hover:bg-gray-700 file:text-white rounded" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" /> 
                        <img id="preview" class="mt-4 w-20 h-20 rounded object-cover hidden" src="" alt="Image preview">
                    </div> --}}
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Ticket Image')" />
                        <input type="file"
                            id="image"
                            name="images[]"
                            multiple
                            accept="*/images"
                            class="w-full text-slate-500 font-medium text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-gray-800 file:hover:bg-gray-700 file:text-white rounded" />
                        <x-input-error :messages="$errors->get('images')" class="mt-2" /> 
                        <img id="preview" class="mt-4 w-20 h-20 rounded object-cover hidden" src="" alt="Image preview">
                    </div>
                    <div class="flex items-center  mt-6">
                        <x-primary-button >
                            {{ __('Add Your Ticket') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset(path: 'assets/js/file/file.js') }}"></script>
</x-app-layout>