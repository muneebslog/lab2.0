<div>
    @if (!$receipt)
        {{-- Lookup form --}}
        <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">View Your Test Status</h2>
            <p class="text-gray-600 mb-6">Enter your receipt number to see the status of your tests and view reports.</p>

            <form wire:submit="lookup" class="space-y-4">
                <div>
                    <label for="receipt" class="block text-sm font-medium text-gray-700 mb-1">Receipt Number</label>
                    <input type="text"
                        id="receipt"
                        wire:model="receipt"
                        placeholder="Enter your receipt number"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        autofocus>
                    @error('receipt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    View my tests
                </button>
            </form>
        </div>
    @else
        {{-- Results --}}
        @if ($error)
            <div class="bg-white shadow-md rounded-xl p-6">
                <p class="text-red-600 mb-4">{{ $error }}</p>
                <a href="{{ route('track-my-tests') }}"
                    wire:navigate
                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                    Try different receipt number
                </a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $patient->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Receipt #{{ $patient->receipt_no }} · {{ $patient->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Test</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Status</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($patient->tests as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($item->pivot->isResultAdded)
                                                <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                    Ready
                                                </span>
                                            @else
                                                <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            @if ($item->pivot->isResultAdded)
                                                <a href="{{ route('showreport', $item->pivot->id) }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-lg bg-green-600 text-white hover:bg-green-700">
                                                    View Report
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('track-my-tests') }}"
                        wire:navigate
                        class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Look up another receipt
                    </a>
                </div>
            </div>
        @endif
    @endif
</div>
