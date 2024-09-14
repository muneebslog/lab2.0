<div class="bg-gray-100 min-h-[88vh] p-4">
    {{-- Patient Info Section --}}
    <h2 class="text-center text-2xl font-bold">Patient Info</h2>
    <div class="bg-white p-3 m-3 rounded shadow">
        <div class="grid grid-cols-4 grid-rows-3 gap-4">
            <div>Medical Record No #</div>
            <div>{{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}</div>
            <div>Invoice Date:</div>
            <div>{{ $patient->created_at->format('d-m-Y') }}</div>
            <div>Name:</div>
            <div>{{ $patient->name }}</div>
            <div>Age:</div>
            <div>{{ $patient->age }}</div>
            <div>Gender:</div>
            <div>{{ $patient->gender }}</div>
            <div>Phone</div>
            <div>{{ $patient->phone }}</div>
        </div>
    </div>

    {{-- Result Entry Section --}}
    <h2 class="text-center text-4xl font-bold">Result Entry</h2>
    @foreach ($patient->tests as $test)
    <div class="bg-white p-3 m-3 rounded shadow">
            <div>
                <h2 class="text-center font-bold text-2xl">{{ $test->name }}</h2>

                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Name</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Result</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Indicators</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Unit</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Normal Range</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($test->testFields as $i => $field)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                    {{ $field->field_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    <div class="max-w-sm space-y-3">
                                                        <input  {{ $i==0 ? "autofocus" : "" }} type="text" wire:model='results.{{ $test->id }}.{{ $field->id }}'
                                                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm disabled:opacity-50 disabled:pointer-events-none result-input"
                                                            placeholder="Enter result" data-min="{{ $field->min_value }}"
                                                            data-max="{{ $field->max_value }}">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    <span class="indicator"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $field->unit }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{ $field->min_value . ' -- ' . $field->max_value }}</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" bg-red-300  ">
                @error($error)
                    {{ $message }}
                @enderror
            </div>
                <div class="flex w-full items-center justify-end">
                    <button wire:click='save({{ $test->id }})' type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Save
                      </button>
                </div>
            </div>

        @endforeach

<script>
    // Get all result input elements
    const resultInputs = document.querySelectorAll('.result-input');

    // Add event listener to each input element
    resultInputs.forEach(input => {
        input.addEventListener('input', function() {
            const minValue = parseFloat(input.getAttribute('data-min'));
            const maxValue = parseFloat(input.getAttribute('data-max'));
            const enteredValue = parseFloat(input.value.trim());

            // Check if entered value is less than minimum
            if (enteredValue < minValue) {
                input.classList.remove('border-gray-300');
                input.classList.add('border-red-500');
                input.closest('tr').querySelector('.indicator').textContent = 'L';
            }
            // Check if entered value is more than maximum
            else if (enteredValue > maxValue) {
                input.classList.remove('border-gray-300');
                input.classList.add('border-orange-500');
                input.closest('tr').querySelector('.indicator').textContent = 'H';
            }
            // Reset to default state
            else {
                input.classList.remove('border-red-500', 'border-orange-500');
                input.classList.add('border-gray-300');
                input.closest('tr').querySelector('.indicator').textContent = '';
            }
        });

    });
</script>
@script
<script>
    $wire.on('message', (e) => {
        alert(e);
    });
</script>
@endscript
</div>

