<div class="">
    {{-- Stop trying to control. --}}
   <!-- Invoice -->
<div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
    <div class="sm:w-11/12 lg:w-3/4 mx-auto">
      <!-- Card -->
      <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
        <!-- Grid -->

        <div class="flex justify-between">
          <div>

<div class="grid grid-cols-2 grid-rows-2 gap-1">
    <div class="row-span-2"><h1 class="mt-2 text-6xl  font-semibold text-blue-900 dark:text-white">Mohsin </h1></div>
    <div class=" flex items-end ">
        <p class=" font-semibold text-blue-900 ">Clinical </p>
    </div>
    <div class="col-start-2 row-start-2 flex items-start">
        <p class="  font-semibold text-blue-900">
            Laboratory
            </p>
        </div>
</div>


          </div>
          <!-- Col -->
          <div class="">
         <img src="{{ asset('images/download.png') }}" class=" size-20" alt="">
          </div>
          <!-- Col -->
        </div>
        <!-- End Grid -->
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200 text-center" >Invoice </h2>

        <!-- Grid -->
        <div class="mt-8 grid sm:grid-cols-2 gap-3">
          <div>
            <dl class="grid sm:grid-cols-5 gap-x-3 mb-1">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Medical Record #:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500"> {{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}</dd>
              </dl>
              <dl class="grid sm:grid-cols-5 mt-1 ">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Name:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->name }}</dd>
              </dl>
              <dl class="grid sm:grid-cols-5 ">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Gender:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500 capitalize">{{ $patient->gender }}</dd>
              </dl>

          </div>
          <!-- Col -->

          <div class="sm:text-end space-y-2">
            <!-- Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
              <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice Date:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->created_at->format('d F Y') }}</dd>
              </dl>
              <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Age:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->age }}</dd>
              </dl>
              <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Phone:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->phone }}</dd>
              </dl>
            </div>
            <!-- End Grid -->
          </div>
          <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Table -->
        <div class="mt-6">
          <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
            <div class="hidden sm:grid sm:grid-cols-4">
              <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Test</div>
              <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Rate</div>
              <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Amount</div>
            </div>

            <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>
            @foreach ($patient->tests as $item)

            <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
              <div class="col-span-full sm:col-span-2">
                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Item</h5>
                <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}</p>
              </div>
              <div>
                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Rate</h5>
                <p class="text-gray-800 dark:text-neutral-200">{{ $item->price }}</p>
              </div>
              <div>
                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Amount</h5>
                <p class="sm:text-end text-gray-800 dark:text-neutral-200">Rs{{ $item->price }}</p>
              </div>
            </div>
            @endforeach

            <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>


          </div>
        </div>
        <!-- End Table -->

        <!-- Flex -->
        <div class="mt-8 flex sm:justify-end">
          <div class="w-full max-w-2xl sm:text-end space-y-2">
            <!-- Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
              {{-- <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Subtotal:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
              </dl> --}}

              {{-- <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Discount:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$50.00</dd>
              </dl> --}}

              <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                <dd class="col-span-2 text-black dark:text-neutral-500">Rs {{ $total }}</dd>
              </dl>
            </div>
            <!-- End Grid -->
          </div>
        </div>
        <!-- End Flex -->

        <div class="mt-8 sm:mt-12">
          <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Thank you!</h4>
          <p class="text-gray-500 dark:text-neutral-500">If you have any questions concerning this invoice, use the following contact information:</p>
          <div class="mt-2">
            <a href="tel:04236662345" class="block text-sm font-medium text-gray-800 dark:text-neutral-200">04236662345</p>
          </div>
        </div>

        <p class="mt-5 text-sm text-gray-500 dark:text-neutral-500">© 2024 MMC.</p>
      </div>
      <!-- End Card -->

      <!-- Buttons -->
      <div class="mt-6 flex justify-end gap-x-3">
        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-neutral-800 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800" target= "_blank" href="{{ route('invoiceDownload', $patient->id)  }}">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
          Invoice PDF
        </a>
        <a  class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" target= "_blank" href="{{ route('invoiceDownload',$patient->id) }}">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
          Print
        </a>
      </div>
      <!-- End Buttons -->
    </div>
  </div>
  <!-- End Invoice -->
</div>
