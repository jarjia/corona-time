<x-layout>
    <nav class='flex justify-between items-center border-b-[1px] border-b-[#F6F6F7] py-4 px-20 sm:px-4'>
            <div>
                <img src='/images/Group 1.png' class='sm:w-[137px]'/>
            </div>
            <div class='flex gap-12'>
                <div>
                    <div x-data="{ show: false }" @click.away="show = false">
                        <button class='flex' @click="show = !show">
                            {{app()->currentLocale() === 'en' ? __('dashboard.english') : __('dashboard.georgian')}}
                            <img src="{{asset('images/down-small.png')}}"/>
                        </button>

                        <div class='absolute p-2 rounded-[8px] bg-[#F6F6F7] mt-2' style='display: none;' x-show="show">
                            <a href="{{route('lang', ['locale' => 'en'])}}" class="block mt-[10px] {{app()->currentLocale() === 'en' ? 'underline' : ''}}">
                                {{__('dashboard.english')}}
                            </a>
                            <a href="{{route('lang', ['locale' => 'ka'])}}" class="block mb-[2px] mt-[10px] {{app()->currentLocale() === 'ka' ? 'underline' : ''}}">
                                {{__('dashboard.georgian')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='flex gap-4 sm:hidden'>
                        <div>
                            <span class='font-[700]'>{{auth()->user()->name}}</span>
                        </div>
                        <div class='h-full w-[1px] bg-[#E6E6E7]'></div>
                        <div>
                            <a href="{{route('logout.destroy')}}">{{__('dashboard.log_out')}}</a>
                        </div>
                    </div>
                    <div class='hidden sm:block' x-data="{ show: false }" @click.away="show = false">
                        <button class='flex w-[24px] h-[24px]' @click="show = !show">
                            <img src="{{asset('images/menu-3-line.png')}}"/>
                        </button>

                        <div class='absolute text-right right-[16px] p-2 rounded-[8px] bg-[#F6F6F7] mt-2' style='display: none;' x-show="show">
                            <p class='font-[700]'>{{auth()->user()->name}}</p>
                            <a href="{{route('logout.destroy')}}">{{__('dashboard.log_out')}}</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </nav>
    <section class='py-4 px-20 sm:px-0 bg-[#FDFDFD]'>
        <section class='flex flex-col border-b-[1px] sm:px-4 border-b-[#F6F6F7]'>
            <div class='py-6'>
                <h2 class='font-[800] text-[25px] sm:text-[20px] leading-[30px]'>
                    {{Request::path() === 'dashboard/world-wide' ? __('dashboard.world_wide_h1') : __('dashboard.by_country_h1')}}
                </h2>
            </div>
            <div class='flex gap-16 sm:gap-8'>
                <div class='{{Request::path() === 'dashboard/world-wide' ? 'border-b-[3px] border-b-[#010414]' : ''}} px-2 py-3'>
                    <a href="{{route('dashboard.index')}}" class='{{Request::path() === 'dashboard/world-wide' ? 'font-[700]' : ''}}'>
                        {{__('dashboard.world_wide')}}
                    </a>
                </div>
                <div class='{{Request::path() === 'dashboard/by-country' ? 'border-b-[3px] border-b-[#010414]' : ''}} px-2 py-3'>
                    <a href="{{route('dashboard.show')}}" class='{{Request::path() === 'dashboard/by-country' ? 'font-[700]' : ''}}'>
                        {{__('dashboard.by_country')}}
                    </a>
                </div>
            </div>
        </section>
        <section>
            {{$slot}}
        </section>
    </section>
</x-layout>