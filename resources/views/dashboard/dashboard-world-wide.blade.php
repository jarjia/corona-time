<x-layout-for-dashboard>
    <section class='py-10 sm:px-4'>
        <section class='grid grid-cols-2 sm:grid-cols-3 gap-8 sm:gap-4'>
            <div class='flex bg-[#2029F3] col-span-1 sm:col-span-2 bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/new-cases.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>{{__('dashboard.new_cases')}}</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#2029F3] sm:text-[25px]'>
                        {{ number_format($new_cases, 0, ',', ',') }}
                    </h3>
                </div>
            </div>
            <div class='flex bg-[#0FBA68] bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/recovered.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>{{__('dashboard.recovered')}}</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#0FBA68] sm:text-[25px]'>
                        {{ number_format($recovered, 0, ',', ',') }}
                    </h3>
                </div>
            </div>
            <div class='flex bg-[#EAD621] bg-opacity-[0.08] flex-col items-center gap-2 rounded-[16px] py-12 w-full'>
                <div class='h-[40%]'>
                    <img src="{{asset('images/deaths.png')}}"/>
                </div>
                <div>
                    <span class='font-[500] text-[20px] sm:text-[16px]'>{{__('dashboard.deaths')}}</span>
                </div>
                <div>
                    <h3 class='font-[900] text-[39px] text-[#EAD621] sm:text-[25px]'>
                        {{ number_format($deaths, 0, ',', ',') }}
                    </h3>
                </div>
            </div>
        </section>
    </section>
</x-layout-for-dashboard>