<x-app-layout >
    <style>
        *{
            border-color: gray;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card -->
      <a href="{{ route('new-case') }}">
      <div class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl">

        <div class="p-4 md:p-6">
          <span class="block mb-1 text-xs font-semibold uppercase text-blue-600">
            New patient entry
          </span>
          <h3 class="text-xl font-semibold text-gray-800">
            New Case
          </h3>
          <p class="mt-3 text-gray-500">
           Add new patient details along with its tests info.
          </p>
        </div>

      </div>
    </a>
      <!-- End Card -->

      <!-- Card -->

      <!-- End Card -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->

</x-app-layout>
