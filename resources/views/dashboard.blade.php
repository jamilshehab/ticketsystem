<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="role-display">
    Role: {{ $user->getRoleNames()->first() }}
</div>
    
</x-app-layout>
