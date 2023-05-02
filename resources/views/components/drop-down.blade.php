<div>
    <div x-data="{ show: false }" @click.away="show = false">
        <button class='flex' @click="show = !show">
            <span class='2xl:text-[24px]'>{{app()->currentLocale() === 'en' ? 'English' : 'ქართული'}}</span>
            <img src="{{asset('images/down-small.png')}}" class='2xl:mt-[6px]'/>
        </button>

        <div style='display: none;' x-show="show" class="absolute z-10 mt-2 p-2 bg-white divide-y rounded-lg shadow">
            <ul class="text-primary-font 2xl:text-[18px]">
                <li>
                    <a href="{{route('lang', ['locale' => 'en'])}}" class="block mt-[10px] {{app()->currentLocale() === 'en' ? 'underline' : ''}}">
                        English
                    </a>
                </li>
                <li>
                    <a href="{{route('lang', ['locale' => 'ka'])}}" class="block mb-[2px] mt-[10px] {{app()->currentLocale() === 'ka' ? 'underline' : ''}}">
                        ქართული
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>