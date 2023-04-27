<div>
                        <div x-data="{ show: false }" @click.away="show = false">
                            <button class='flex' @click="show = !show">
                                {{app()->currentLocale() === 'en' ? __('dashboard.english') : __('dashboard.georgian')}}
                                <img src="{{asset('images/down-small.png')}}"/>
                            </button>

                            <div style='display: none;' x-show="show" class="absolute z-10 mt-2 p-2 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                                <ul class="text-primary-font text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="{{route('lang', ['locale' => 'en'])}}" class="block mt-[10px] {{app()->currentLocale() === 'en' ? 'underline' : ''}}">
                                            {{__('dashboard.english')}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('lang', ['locale' => 'ka'])}}" class="block mb-[2px] mt-[10px] {{app()->currentLocale() === 'ka' ? 'underline' : ''}}">
                                            {{__('dashboard.georgian')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>