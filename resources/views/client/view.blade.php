<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if ($tickets->count()>0)
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Content
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
   
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      
        <tbody>
           @foreach ($tickets as $ticket)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                   @if($ticket->image)
                   <img src="{{ asset('storage/' . $ticket->image) }}" 
                    alt="Problem image" 
                    class="w-16 h-auto rounded-md">
                   @else
                    —
                   @endif
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{$ticket->title}}</div>
                        <div class="font-normal text-gray-500">{{$ticket->content}}</div>
                    </div>  
                </th>
                <td class="px-6 py-4">
                
                </td>
              <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit </a>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
            </tr>
           @endforeach
           
           
        </tbody>
    </table>
     @else
     <p>No Posts Found</p>
     @endif
</div>
</x-app-layout>