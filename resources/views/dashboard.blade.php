<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-center bg-[#010814]">
        <div class="w-full max-w-2xl">
            <div class="py-12 text-white text-base">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>
