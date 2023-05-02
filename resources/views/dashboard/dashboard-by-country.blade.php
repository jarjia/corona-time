<x-layout-for-dashboard>
    <section class='pt-6 sm:pt-2'>
        <section class='sm:px-0'>
            <form method='GET' action="{{route('dashboard.show')}}">
                @if (request('column'))
                    <input type='hidden' name='column' value="{{ request('column') }}"/>
                @endif
                @if (request('direction'))
                    <input type='hidden' name='direction' value="{{ request('direction') }}"/>
                @endif
                <div class="relative w-[300px] sm:w-full rounded-md">
                    <input type="text" name="search" id="search" 
                        class="form-input rounded-[8px] py-4 block w-full sm:w-full focus:ring-0 sm:border-0 border-[1px] border-[#E6E6E7] pl-10 focus:outline-none"
                        placeholder="{{__('inputs.search')}}"
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
        <div class="mt-6 sm:mt-4 rounded-[8px] shadow">
            <table class="text-left w-full">
                <thead class="bg-[#F6F6F7] font-[900] sm:text-[12px] rounded-t-[8px] flex text-black w-full">
                    <tr class="flex w-full">
                        <x-table-heads :name="'location'" :column="'name'"/>
                        <x-table-heads :name="'new_cases'" :column="'new_cases'"/>
                        <x-table-heads :name="'deaths'" :column="'deaths'"/>
                        <x-table-heads :name="'recovered'" :column="'recovered'"/>
                    </tr>
                </thead>
                <tbody class="bg-grey-light font-[500] max-h-[500px] sm:text-[11px] flex flex-col scrollbar items-center justify-between overflow-y-scroll w-full">
                    <tr class="flex w-full mb-4">
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{__('dashboard.world_wide')}}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($new_cases, 0, ',', ',') }}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($deaths, 0, ',', ',') }}</td>
                        <td class="p-3 sm:p-1 w-1/4 text-black">{{ number_format($recovered, 0, ',', ',') }}</td>
                    </tr>
                    @foreach ($countries as $country)
                        <tr class="flex w-full mb-4">
                            <td class="p-3 sm:p-1 w-1/4 text-black capitalize">{{$country->name}}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black capitalize">{!! $country->new_cases < 1 ? '<strong>-</strong>' : $country->new_cases !!}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black capitalize">{!! $country->deaths < 1 ? '<strong>-</strong>' : $country->deaths !!}</td>
                            <td class="p-3 sm:p-1 w-1/4 text-black capitalize">{!! $country->recovered < 1 ? '<strong>-</strong>' : $country->recovered !!}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>
</x-layout-for-dashboard>