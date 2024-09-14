<div class="">
    <x-slot name="no">
        {{ $data->id }}

    </x-slot>

    <div class="flex justify-between gap-x-5   mx-4 p-1 px-3  max-w-[100vw]  border-t border-b">
        <div class=" w-1/2">


            <div class="grid grid-cols-2  ">
                <div>Patient Name</div>
                <div class=" uppercase text-right">{{ $data->patient->name }}</div>
            </div>
            <div class="flex justify-between">
                <div>Receipt Number</div>
                <div>{{ $data->patient->receipt_no }}</div>
            </div>
            <div class="flex justify-between">
                <div class="row-start-3">Age:</div>
                <div class="row-start-3">{{ $data->patient->age }} {{ $data->patient->age_unit }}</div>
            </div>
            <div class="flex justify-between">
                <div class="row-start-4">Sample Date</div>
                <div class="row-start-4">{{ $data->patient->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="row-span-4 flex w-1/3 flex-col justify-center items-center">
            {{ QrCode::size(60)->generate(route('showreport', $data->id)) }}
            <p class="font-serif text-center">Track Online</p>
        </div>
        <div class="w-1/2">
            <div class="grid grid-cols-2 ">
                <div>Reffered By</div>
                <div class=" flex justify-end">
                    {{ $data->patient->doctor }}

                </div>

            </div>

            <div class="flex justify-between">
                <div class="col-start-4">Sex</div>
                <div class="col-start-5 capitalize">{{ $data->patient->gender }}</div>
            </div>

            <div class="flex justify-between">
                <div class="col-start-4 row-start-3">Phone</div>
                <div class="col-start-5 row-start-3">{{ $data->patient->phone }}</div>
            </div>

            <div class="flex justify-between">
                <div class="col-start-4 row-start-4">Report Date:</div>
                <div class="col-start-5 row-start-4">{{ $data->patient->updated_at->format('d M Y') }}</div>
            </div>

        </div>

    </div>


    <div class="max-w-4xl mx-auto bg-white  rounded-lg overflow-hidden">
        <h2 class=" text-xl underline uppercase my-3 text-center text-bold font-serif">
            {{ $data->test->department }} Reports
        </h2>
        <h2 class=" underline text-xl  my-4  text-bold font-serif">
            {{ $data->test->name }} @if ($data->test->short_hand)
                ( {{ $data->test->short_hand }} )
            @endif
        </h2>
        @php
            $codes = json_decode(file_get_contents(public_path('test_codes.json')), true);
        @endphp
        @if ($data->test->code == 1122)
            <div class=" grid grid-cols-2 gap-4">
                <div class="">
                    <table class="  w-full  leading-normal">
                        <thead>
                            <tr>
                                <th colspan="2"
                                    class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                    PHYSICAL EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 39 && $item->testField->id < 53)
                                    <tr>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->testField->field_name }}

                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->result }}

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="">
                    <table class="  w-full  leading-normal">
                        <thead>
                            <tr>
                                <th colspan="3"
                                    class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                    MICROSCOPIC EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 52 && $item->testField->id < 63)
                                    <tr>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->testField->field_name }}
                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->result }}

                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            @if (
                                                $item->testField->id == 53 ||
                                                    $item->testField->id == 54 ||
                                                    $item->testField->id == 55 ||
                                                    $item->testField->id == 58 ||
                                                    $item->testField->id == 59 ||
                                                    $item->testField->id == 60)
                                                /HPF
                                            @endif

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @elseif (in_array($data->test->code, $codes['codes']))
            <div class="">
                <table class="  w-full  leading-normal">
                    @if ($data->test->code == 2800)
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->result }}


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif ($data->test->code == 4232)
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300 text-center">

                                        {{ $item->result }}



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->result }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif

                </table>
            </div>
        @else
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-l border-gray-300 text-left text-sm uppercase">
                            Test Name
                        </th>
                        <th
                            class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                            Normal Value
                        </th>
                        <th
                            class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                            Unit
                        </th>
                        <th
                            class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">

                        </th>
                        <th
                            class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-r border-t border-gray-300 text-left text-sm uppercase">
                            Result
                        </th>
                    </tr>
                </thead>
                @php
                // Function to convert time (Minutes:Seconds) to total seconds
                function timeToSeconds($time)
                {
                    list($minutes, $seconds) = explode(':', $time);
                    return ($minutes * 60) + $seconds;
                }
            @endphp

            <tbody>
                @foreach ($data->testResults as $i => $item)
                    @php
                        // Check if the unit is 'Minutes:Seconds' (for time-based tests)
                        $isTimeBased = strtolower($item->testField->unit) === 'minutes:seconds';

                        // Compare based on whether it's time-based or numeric
                        if ($isTimeBased) {
                            // Convert times to seconds for comparison
                            $resultInSeconds = timeToSeconds($item->result);
                            $minValueInSeconds = timeToSeconds($item->testField->min_value);
                            $maxValueInSeconds = timeToSeconds($item->testField->max_value);
                        } else {
                            // Use numeric comparison
                            $resultInSeconds = $item->result;
                            $minValueInSeconds = $item->testField->min_value;
                            $maxValueInSeconds = $item->testField->max_value;
                        }
                    @endphp

                    <tr class="">
                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                            {{ $item->testField->field_name }}
                        </td>
                        <td class="px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $item->testField->min_value }} - {{ $item->testField->max_value }}
                        </td>
                        <td class="px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $item->testField->unit }}
                        </td>
                        <td
                            class="{{ $resultInSeconds < $minValueInSeconds || $resultInSeconds > $maxValueInSeconds ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap border-gray-300">
                            @if ($resultInSeconds < $minValueInSeconds)
                                L
                            @elseif ($resultInSeconds > $maxValueInSeconds)
                                H
                            @else
                                {{-- No action --}}
                            @endif
                        </td>
                        <td class="{{ $resultInSeconds < $minValueInSeconds || $resultInSeconds > $maxValueInSeconds ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $item->result }}
                        </td>
                    </tr>

                    @if ($data->test->code == 1300 && $i == 7)
                        <tr>
                            <td colspan="4" class="px-6 py-1 whitespace-no-wrap font-bold underline border-gray-300">
                                Differential Leukocytes Count:
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

            </table>
        @endif



    </div>
</div>
