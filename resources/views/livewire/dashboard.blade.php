<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        {{-- Lab technician reminder stats --}}
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Lab workload overview</h3>
            <p class="text-sm text-gray-600 mb-4">Multiple technicians: here's what's left to process.</p>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                {{-- Today's tests left - primary focus --}}
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-amber-700">{{ $stats['today_tests_left'] }}</div>
                    <div class="text-sm font-medium text-amber-800">Today's tests left</div>
                    <p class="text-xs text-amber-600 mt-1">Results pending for today's cases</p>
                </div>

                {{-- Today's cases pending --}}
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-700">{{ $stats['today_cases_pending'] }}</div>
                    <div class="text-sm font-medium text-orange-800">Today's cases awaiting</div>
                    <p class="text-xs text-orange-600 mt-1">Cases with tests still to complete</p>
                </div>

                {{-- Total tests left (all time) --}}
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-red-700">{{ $stats['total_tests_left'] }}</div>
                    <div class="text-sm font-medium text-red-800">Total tests left</div>
                    <p class="text-xs text-red-600 mt-1">All pending across all dates</p>
                </div>

                {{-- Total cases awaiting --}}
                <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-rose-700">{{ $stats['total_cases_awaiting'] }}</div>
                    <div class="text-sm font-medium text-rose-800">Cases awaiting results</div>
                    <p class="text-xs text-rose-600 mt-1">Patients with pending tests</p>
                </div>

                {{-- Today's cases completed --}}
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-emerald-700">{{ $stats['today_cases_done'] }}</div>
                    <div class="text-sm font-medium text-emerald-800">Today completed</div>
                    <p class="text-xs text-emerald-600 mt-1">Cases fully done today</p>
                </div>

                {{-- Today's total cases --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-blue-700">{{ $stats['today_cases'] }}</div>
                    <div class="text-sm font-medium text-blue-800">Today's new cases</div>
                    <p class="text-xs text-blue-600 mt-1">Total cases received today</p>
                </div>
            </div>

            @if($stats['today_tests_left'] > 0 || $stats['total_tests_left'] > 0)
                <a href="{{ route('cases-list') }}"
                    class="inline-flex items-center gap-x-2 px-4 py-2 text-sm font-semibold rounded-lg border border-amber-300 bg-amber-100 text-amber-800 hover:bg-amber-200">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                    </svg>
                    View case list to add results
                </a>
            @endif
        </div>

        {{-- Quick action cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('new-case') }}"
                class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl hover:border-blue-300 hover:shadow-md transition">
                <div class="p-4 md:p-6">
                    <span class="block mb-1 text-xs font-semibold uppercase text-blue-600">New patient entry</span>
                    <h3 class="text-xl font-semibold text-gray-800">New Case</h3>
                    <p class="mt-3 text-gray-500">Add new patient details along with its tests info.</p>
                </div>
            </a>

            <a href="{{ route('cases-list') }}"
                class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl hover:border-blue-300 hover:shadow-md transition">
                <div class="p-4 md:p-6">
                    <span class="block mb-1 text-xs font-semibold uppercase text-blue-600">View all cases</span>
                    <h3 class="text-xl font-semibold text-gray-800">Case List</h3>
                    <p class="mt-3 text-gray-500">View patients, add results, and manage lab workload.</p>
                </div>
            </a>
        </div>
    </div>
</div>
