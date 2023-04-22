<x-layout-for-dashboard>
    <section class='py-10'>
        <section class='sm:px-0'>
            <form method='GET' action="{{route('dashboard.show')}}">
                @if (request('sort'))
                    <input type='hidden' name='sort' value="{{ request('sort') }}"/>
                @endif
                @if (request('sort_type'))
                    <input type='hidden' name='sort_type' value="{{ request('sort_type') }}"/>
                @endif
                <div class="relative w-[300px] sm:w-full rounded-md">
                    <input type="text" name="search" id="search" 
                        class="form-input rounded-[8px] py-4 block w-full sm:w-full focus:ring-0 sm:border-0 border-[1px] border-[#E6E6E7] pl-10 focus:outline-none"
                        placeholder="Search by country"
                        value="{{request('search')}}"
                        autocomplete='off'
                        style="outline:none;"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{asset('images/search.png')}}"/>
                    </div>
                </div>
            </form>
        </section>
        <div class="container mt-12 sm:mt-4 rounded-[8px] shadow">
            <table class="text-left w-full">
                <thead class="bg-[#F6F6F7] font-[900] sm:text-[12px] rounded-t-[8px] flex text-black w-full">
                    <tr class="flex w-full">
                        <th class="p-4 sm:p-1 w-1/4 flex sm:text-[10px] items-center sm:gap-0 gap-2">
                            {{__('dashboard.location')}}
                            <a href="{{route('dashboard.show', ['sort' => 'name', 'sort_type' => $count, 'search' => request('search')])}}" class='py-1 px-1'>
                                @if ($sort_name === 'name' && $sort_type === 'desc')
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='mb-[4px] sm:w-[8px] rotate-180'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px]'/>
                                @else
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px]'/>
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='sm:w-[8px]'/>
                                @endif
                            </a>
                        </th>
                        <th class="p-4 sm:p-1 w-1/4 flex sm:text-[10px] items-center sm:gap-0 gap-2">
                            <span>{{__('dashboard.new_cases')}}</span>
                            <a href="{{route('dashboard.show', ['sort' => 'new_cases', 'sort_type' => $count, 'search' => request('search')])}}" class='py-1 px-1'>
                                @if ($sort_name === 'new_cases' && $sort_type === 'desc')
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='mb-[4px] min-w-[8px] sm:w-[8px] rotate-180'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px] min-w-[8px]'/>
                                @elseif ($sort_name === 'new_cases' && $sort_type === 'asc')
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] min-w-[8px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='sm:w-[8px] min-w-[8px]'/>
                                @else
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] min-w-[8px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px] min-w-[8px]'/>
                                @endif
                            </a>
                        </th>
                        <th class="p-4 sm:p-1 w-1/4 flex sm:text-[10px] items-center sm:gap-0 gap-2">
                            {{__('dashboard.deaths')}}
                            <a href="{{route('dashboard.show', ['sort' => 'deaths', 'sort_type' => $count, 'search' => request('search')])}}" class='py-1 px-1'>
                                @if ($sort_name === 'deaths' && $sort_type === 'desc')
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='mb-[4px] sm:w-[8px] rotate-180'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px]'/>
                                @elseif ($sort_name === 'deaths' && $sort_type === 'asc')
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='sm:w-[8px]'/>
                                @else
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px]'/>
                                @endif
                            </a>
                        </th>
                        <th class="p-4 sm:p-1 w-1/4 flex sm:text-[10px] items-center sm:gap-0 gap-2">
                            <span class='truncate'>{{__('dashboard.recovered')}}</span>
                            <a href="{{route('dashboard.show', ['sort' => 'recovered', 'sort_type' => $count, 'search' => request('search')])}}" class='py-1 px-1'>
                                @if ($sort_name === 'recovered' && $sort_type === 'desc')
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='mb-[4px] sm:w-[8px] rotate-180'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px]'/>
                                @elseif ($sort_name === 'recovered' && $sort_type === 'asc')
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-colored.png')}}" class='sm:w-[8px]'/>
                                @else
                                    <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:w-[8px]'/>
                                    <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px]'/>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-grey-light font-[500] max-h-[604px] sm:text-[11px] flex flex-col scrollbar items-center justify-between overflow-y-scroll w-full">
                    <tr class="flex w-full mb-4">
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{__('dashboard.world_wide')}}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($new_cases, 0, ',', ',') }}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($deaths, 0, ',', ',') }}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($recovered, 0, ',', ',') }}</td>
                    </tr>
                    @foreach ($countries as $country)
                        <tr class="flex w-full mb-4">
                            <td class="p-3 sm:p-1 w-1/4 text-black">{{$country->name}}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black">{!! $country->new_cases < 1 ? '<strong>-</strong>' : $country->new_cases !!}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black">{!! $country->deaths < 1 ? '<strong>-</strong>' : $country->deaths !!}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black">{!! $country->recovered < 1 ? '<strong>-</strong>' : $country->recovered !!}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>
</x-layout-for-dashboard>