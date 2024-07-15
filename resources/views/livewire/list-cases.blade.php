<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Cases
                                </h2>
                                <p class="text-sm text-gray-600">
                                    Add users, edit and more.
                                </p>
                            </div>

                            <div>
                                <div class="inline-flex gap-x-2">
                                    <div>
                                        <div class="inline-flex gap-x-2">
                                            <button wire:click='prevDay' type="button"
                                                class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="m15 18-6-6 6-6" />
                                                </svg>
                                                Prev
                                            </button>
                                            <div class="border rounded p-2">
                                                @if ($date->isToday())
                                                    Today
                                                @else
                                                    {{ $date->format('d F Y') }}
                                                @endif
                                            </div>

                                            <button wire:click='nextDay' type="button"
                                                class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                Next
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                        href="{{ route('new-case') }}">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                        Add user
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">



                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            Name
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                    <div class="flex text-center items-center gap-x-2">
                                        <span class="  text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            Medical Record #
                                        </span>
                                    </div>
                                </th>



                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            Status
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            Portfolio
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                            Created
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($patients as $item)
                                @php
                                $countIsResultAdded = $item->tests
                                    ->filter(function ($test) {
                                        return $test->pivot->isResultAdded == 1;
                                    })
                                    ->count();
                                    $totalTests = count($item->tests);
                                    if ($totalTests == 0) {
                                        $bar = 100;
                                    }else {
                                        $bar = ($countIsResultAdded/$totalTests)*100;
                                    }
                            @endphp
                                <tr class="hover:bg-gray-100 dark:hover:bg-neutral-70">
                                    <td class="size-px whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-3">
                                            <div class="flex items-center gap-x-3">
                                                <span
                                                    class="inline-flex items-center justify-center size-[38px] rounded-full bg-white border border-gray-300">
                                                    <span
                                                        class="font-medium text-sm text-gray-800 leading-none">
                                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                                    </span>
                                                </span>
                                                <div class="grow">
                                                    <span
                                                        class="block text-sm font-semibold capitalize text-gray-800">{{ $item->name }}</span>
                                                    <span
                                                        class="block text-sm text-gray-500">{{ $item->phone }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-3">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    {{ $item->created_at->format('d-m-Y') }}-{{ $item->id }}
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-3">
                                            @if ($countIsResultAdded == $totalTests)
                                            <div class="px-6 py-3">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">
                                                    <svg class="size-2.5"
                                                        xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                    </svg>
                                                    Done
                                                </span>
                                            </div>
                                            @elseif ($countIsResultAdded != $totalTests && $countIsResultAdded !=0 )
                                            <div class="px-6 py-3">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                                    <svg class="size-2.5"
                                                        xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                    {{ $totalTests-$countIsResultAdded }} Left
                                                </span>
                                            </div>
                                            @elseif ($countIsResultAdded==0)
                                            <div class="px-6 py-3">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                                    <svg class="size-2.5"
                                                        xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                    None Done
                                                </span>
                                            </div>
                                            @else

                                            @endif
                                        </a>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-3">
                                            <div class="px-6 py-3">
                                                <div class="flex items-center gap-x-3">
                                                    <span
                                                        class="text-xs text-gray-500">
                                                        {{ $countIsResultAdded }}/{{ $totalTests }}
                                                    </span>
                                                    <div
                                                        class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                                        <div
                                                            class="flex flex-col justify-center overflow-hidden bg-gray-800"
                                                            role="progressbar"
                                                            style="width: {{ $bar }}%"
                                                            aria-valuenow="25"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-3">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="text-sm text-gray-500">{{ $item->created_at->format('j M, H:i') }}
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <a href="{{ route('invoice', $item->id) }}"
                                            class="cursor-pointer block px-6 py-1.5">
                                            <div class="px-6 py-1.5">
                                                <span
                                                    class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium">
                                                    Edit
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">{{ count($patients) }}</span> results
                                </p>
                            </div>


                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
</div>
