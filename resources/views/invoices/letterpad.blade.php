<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Set A4 size with margins for printing */
        @page {
            size: A4;
            /* margin: 2cm; */
        }

        /* Apply styles to the body element */
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
    </style>

</head>

<body>
    <div class=" w-full">
        <div class=" w-full">
            <!-- Card -->
            <div class="flex flex-col  bg-white  rounded-xl dark:bg-neutral-800">
                <div class="flex justify-between  items-center">

                    <div class="flex">
                        <div class="">
                            <h1 class="mt-2 text-6xl  font-semibold text-blue-900 dark:text-white">Mohsin </h1>
                            <div class=" mx-1">
                                <p>PHC REG # R 13048</P>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class=" h-1/2 flex items-end">
                                <p class=" font-semibold text-blue-900 ">Clinical </p>
                            </div>
                            <div class=" h-1/2">
                                <p class="  font-semibold text-blue-900">
                                    Laboratory
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class=" flex gap-3">
                        <div class="">Medical Record No:</div>
                        <div class="flex flex-col">
                            <div class=""><img class="h-[30px]" src="{{ asset('images/download (1).png') }}" alt=""></div>
                            <div class="text-center">
                                <span class="">{{ now()->format('d-m-Y') }}-13</sapn>
                            </div>

                        </div>
                    </div>
                    <!-- Col -->
                </div>
            </div>
        </div>
        <!-- End Invoice -->
    </div>
    <div class="">

<div class="grid grid-cols-5 mt-3 grid-rows-3 gap-1 p-1 border-t border-b">
    <div class="">Patient Name</div>
    <div >: Anaya Maqsood</div>
    <div class="col-start-4 row-start-1">Age /  Sex</div>
    <div class="col-start-5 row-start-1">:  04 Yrs. / Female</div>
    <div class="col-start-1 row-start-2">Referred by Doctor</div>
    <div class="col-start-2 row-start-2">:	Dr. Ahtisham Sb</div>
    <div class="col-start-4 row-start-2">Sample Date</div>
    <div class="col-start-5 row-start-2">:	13 – 07 – 2024</div>
    <div class="col-start-1 row-start-3">Phone / Cell No. </div>
    <div class="col-start-2 row-start-3">:	0315-4161461</div>
    <div class="col-start-4 row-start-3">Reports Date</div>
    <div class="col-start-5 row-start-3">:	14 – 07 – 2024</div>
    <div class="row-span-3 col-start-3 row-start-1 my-1 flex items-center flex-col  ">
        <img src="{{ asset('images/download.png') }}" class=" size-20" alt="">
        <p>Track Online</p>
    </div>
</div>


    </div>

    <footer class="fixed bottom-0 w-full ">
        <div class="">
            <p class=" text-center"> Electronically verified report. No signature(s) required. Not valid for Court</p>
            <div class="grid text-center m-1 mb-2 border-black border-t grid-cols-4 grid-rows-1 gap-4">
                <div class="text-center">
                    <h3 class=" font-serif font-bold text-sm">Dr. Tariq Saeed</h3>
                    <p class="font-serif font-bold text-xs">M.B.B.S. M.C.P.S, F.C.P.S</p>
                    <p class="font-serif font-bold text-xs">Asst prof. surgery Shalimar</p>
                </div>
                <div>
                    <h3 class=" font-serif font-bold text-sm">Dr. Muhammad Sohail</h3>
                    <p class="font-serif font-bold text-xs">M.B.B.S, MS (UROLOGY) </p>
                    <p class="font-serif font-bold text-xs">Consultant Urologist</p>
                </div>
                <div>
                    <h3 class=" font-serif font-bold text-sm"> Muhammad Asghar</h3>
                    <p class="font-serif font-bold text-xs"> Sr. Lab Technician </p>
                </div>
                <div>
                    <h3 class=" font-serif font-bold text-sm">Muhammad Zia Ul Haq</h3>
                    <p class="font-serif font-bold text-xs"> Biochemist & Molecular Biologist </p>

                </div>
            </div>


        </div>
        <div class=" text-center pt-1 text-white  text-sm p-3 bg-indigo-900">
            <p>433/12-A, Peer Colony,St # 1, Walton Road, Lahore, Cell: 0320 84 89 685 | Ph: 042 36 66 2345</p>
            <p>Email: mmclahore@gmail.com Website: mohsinmedicalcomplex.com</p>
        </div>
    </footer>


</body>

</html>
