<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white p-8 shadow-xl rounded-lg">
                <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Submit A New Department</h2>
                
                <form method="POST" action="{{ route('department.store') }}"   class="space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Department Title')" />
                        <x-text-input id="title" class="block mt-1 w-full px-3 py-2" type="text" name="department_name" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                    </div>
                    <div class="">
                <select name="head_of_department_id" class="select" required>
                  @foreach ($agents as $agent)
                     <option  value="{{ $agent->id }}">
                    {{ $agent->firstName }} {{ $agent->lastName }} 
                   @if($agent->department)
                  - {{ $agent->department->department_name }}
                   @endif
                 </option>
                @endforeach
               </select>
                         
                     </div>
                    <div class="flex items-center  mt-6">
                        <x-primary-button >
                            {{ __('Add Department') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </x-app-layout>