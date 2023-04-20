<x-layout-for-dashboard>
    <section class='py-10 sm:px-4'>
        <section class='grid grid-cols-2 sm:grid-cols-3 gap-8 sm:gap-4'>
            <div class='flex bg-[#2029F3] col-span-1 sm:col-span-2 bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/newCases.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>New cases</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#2029F3] sm:text-[25px]'>715,523</h3>
                </div>
            </div>
            <div class='flex bg-[#0FBA68] bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/recovered.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>Recovered</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#0FBA68] sm:text-[25px]'>72,005</h3>
                </div>
            </div>
            <div class='flex bg-[#EAD621] bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/deaths.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>Death</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#EAD621] sm:text-[25px]'>8,332</h3>
                </div>
            </div>
        </section>
        <section class='mt-24'>
            <div class="flex flex-col items-center py-16 rounded-[16px] bg-gradient-to-r from-[#FCFF81] via-[#C2FF9D] to-[#75A4FF]">
                <div class='text-center'>
                    <h3 class='text-[25px] mb-2 font-[900] sm:text-[20px]'>Get notified first</h3>
                    <span class='font-[500] sm:text-[14px]'>Get <strong>personalised</strong> notifications via email</span>
                </div>
                <div class='mt-6'>
                    <form method='POST' action='#'>
                        <div class="sm:flex sm:justify-center relative rounded-md shadow-sm">
                            <input type="email" name="email" id="email" 
                                class="form-input rounded-[32px] py-4 px-32 block w-full sm:w-5/6 border-[1px] border-[#E6E6E7] pl-10 sm:text-sm sm:leading-5"
                                placeholder="Enter your email"
                                autocomplete='off'
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-10 flex items-center pointer-events-none">
                                <img src="{{asset('images/search.png')}}"/>
                            </div>
                            <button type="submit" class="m-[6px] text-[14px] rounded-[27px] absolute inset-y-0 right-0 sm:right-[28px] px-4 py-2 text-white bg-[#0FBA68]">
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</x-layout-for-dashboard>