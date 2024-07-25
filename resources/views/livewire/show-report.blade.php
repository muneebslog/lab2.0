

    <div class="">
        <x-slot name="no">
            {{ $data->id }}

        </x-slot>

        <div class="grid text-sm grid-cols-5 mt-3 grid-rows-3 gap-1 p-1 border-t border-b">
            <div class="font-serif">Patient Name</div>
            <div class="font-serif">: {{ $data->patient->name }}</div>
            <div class="col-start-4 row-start-1 font-serif">Age / Sex</div>
            <div class="col-start-5 row-start-1 font-serif">: <span class="font-sans"> {{ $data->patient->age }} </span>Yrs. / <span class=" capitalize"> {{ $data->patient->gender }}</span></div>
            <div class="col-start-1 row-start-2 font-serif">Referred by Doctor</div>
            <div class="col-start-2 row-start-2 font-serif">: Self </div>
            <div class="col-start-4 row-start-2 font-serif">Sample Date</div>
            <div class="col-start-5 row-start-2 text-bold">: {{ $data->created_at->format('d M Y')  }}</div>
            <div class="col-start-1 row-start-3 font-serif">Phone / Cell No. </div>
            <div class="col-start-2 row-start-3">: {{ $data->patient->phone }}</div>
            <div class="col-start-4 row-start-3 font-serif">Reports Date</div>
            <div class="col-start-5 row-start-3">: {{ $data->updated_at->format('d M Y') }}</div>
            <div class="row-span-3 col-start-3 row-start-1 my-1 flex items-center flex-col  ">
                {{-- <img src="{{ asset('images/download.png') }}" class=" size-20" alt=""> --}}
                {{  QrCode::size(60)->generate(route('showreport',$data->id)) }}
                <p class="font-serif">Track Online</p>
            </div>


    </div>
    <div class="max-w-4xl mx-auto bg-white  rounded-lg overflow-hidden">
        <h2 class=" text-xl underline my-3 text-center text-bold font-serif">
            @if ($data->test->code == 1300 || $data->test->code == 1509)

            HEMATOLOGY REPORT

            @elseif ($data->test->code == 2704 || $data->test->code == 1618 || $data->test->code == 1900)
            BIOCHEMISTRY REPORTS
            @elseif ($data->test->code == 1122)
            MICROBIOLOGY REPORT
            @endif
        </h2>
        <h2 class=" underline text-xl  my-4  text-bold font-serif">
            @if ($data->test->code == 1300)
            Complete Blood Count (CBC)

            @elseif($data->test->code == 1509)
            LIVER FUNCTION TEST (LFT)
            @elseif($data->test->code == 1618)

            RENAL FUNCTION TEST (RFT)
            @elseif($data->test->code == 1900)
            LIPID PROFILE
            @elseif($data->test->code == 1122)
            URINE EXAMINATION
            @elseif($data->test->code == 2800)
            BLOOD BANKING
            @endif

        </h2>
        @if ($data->test->code == 1122)
        <div class=" grid grid-cols-2 gap-4">
            <div class="">
                <table class="  w-full  leading-normal">
                    <thead>
                        <tr>
                            <th colspan="2" class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                PHYSICAL EXAMINATION
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach ($data->testResults as $i => $item)
                        @if ($item->testField->id >39 && $item->testField->id <53)

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
                            <th colspan="3" class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                MICROSCOPIC EXAMINATION
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->testResults as $i => $item)
                        @if ($item->testField->id >52 && $item->testField->id <63)

                        <tr>
                            <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                            {{ $item->testField->field_name }}
                            </td>
                            <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                        {{ $item->result }}

                            </td>
                            <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                               @if ($item->testField->id == 53 || $item->testField->id== 54||$item->testField->id == 55 || $item->testField->id == 58 || $item->testField->id== 59||$item->testField->id == 60)

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

        @elseif ($data->test->code == 2800)
        <div class="">
            <table class="  w-full  leading-normal">

                <tbody class="font-bold">
            @foreach ($data->testResults as $i => $item)

                    <tr>
                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                            {{ $item->testField->field_name }}

                        </td>
                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                           @if ($i == 0)
                              (
                    {{ $item->result }}

                              )
                              @else

                              {{ $item->result }}
                           @endif

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-l border-gray-300 text-left text-sm uppercase">
                        Test Name
                    </th>
                    <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                        Normal Value
                    </th>
                    <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                        Unit
                    </th>
                    <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">

                    </th>
                    <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-r border-t border-gray-300 text-left text-sm uppercase">
                        Result
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->testResults as $i => $item)

                <tr class="">
                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                        {{ $item->testField->field_name }}
                    </td>
                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                        {{ $item->testField->min_value }} - {{ $item->testField->max_value }}
                    </td>
                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                        {{ $item->testField->unit }}
                    </td>
                    <td class="{{ $item->result < $item->testField->min_value || $item->result > $item->testField->max_value ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap border-gray-300">
                        @if ($item->result < $item->testField->min_value)
                            L
                        @elseif ($item->result > $item->testField->max_value)
                            H
                        @else
                            {{-- No action --}}
                        @endif
                    </td>
                    <td class=" {{ $item->result < $item->testField->min_value || $item->result > $item->testField->max_value ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap  border-gray-300">
                        {{ $item->result }}
                    </td>
                </tr>
                @if ($data->test->code == 1300 && $i == 7)
                <tr>
                    <td colspan="4" class="px-6 py-1 whitespace-no-wrap  font-bold underline  border-gray-300">
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


