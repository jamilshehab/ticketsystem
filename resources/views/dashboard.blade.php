<x-app-layout>
     
   
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 place-items-center">
  <!-- User Card -->
  <div class="card w-full max-w-md bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 rounded-xl overflow-hidden">
    <div class="p-6 space-y-4">
      <div class="flex items-center justify-between">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm font-medium rounded-full">User</span>
      </div>
      <div>
        <h4 class="text-lg font-medium text-gray-500 uppercase tracking-wider">Name</h4>
        <h3 class="text-2xl font-bold text-gray-800 mt-1">
          {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
        </h3>
      </div>
    </div>
  </div>

  <!-- Email Card -->
  <div class="card w-full max-w-md bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 rounded-xl overflow-hidden">
    <div class="p-6 space-y-4">
      <div class="flex items-center justify-between">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Contact</span>
      </div>
      <div>
        <h4 class="text-lg font-medium text-gray-500 uppercase tracking-wider">Email</h4>
        <h3 class="text-xl font-semibold text-gray-700 mt-1 break-all">
          {{ Auth::user()->email }}
        </h3>
      </div>
    </div>
  </div>

  <!-- Role Card -->
  <div class="card w-full max-w-md bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 rounded-xl overflow-hidden">
    <div class="p-6 space-y-4">
      <div class="flex items-center justify-between">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-sm font-medium rounded-full">Role</span>
      </div>
      <div>
        <h4 class="text-lg font-medium text-gray-500 uppercase tracking-wider">Your Role</h4>
        <h3 class="text-2xl font-bold text-emerald-600 mt-1 capitalize">
          {{ auth()->user()->getRoleNames()->first() }}
        </h3>
      </div>
    </div>
  </div>

 
</div>
</x-app-layout>
