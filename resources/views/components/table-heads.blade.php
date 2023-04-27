@props(['column', 'name'])
<th class="p-4 sm:p-1 w-1/4 sm:text-[10px]">
    <a href="{{route('dashboard.show',
        [
        'column' => $column, 
        'direction' => request()->query('column') === $column && request()->query('direction') !== 'desc' ? 'desc' : 'asc', 
        'search' => request('search')
        ])}}"
        class='flex items-center sm:gap-[2px] gap-2' 
    >
        <div>
            <span>{{__('dashboard.'.$name)}}</span>
        </div>
        <div>
        @if (request()->query('column') === $column && request()->query('direction') === 'desc')
        <img src="{{asset('images/arrows/down-colored.png')}}" class='mb-[4px] sm:mb-[2px] min-w-[8px] sm:w-[8px] rotate-180'/>
        <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px] min-w-[8px]'/>
        @elseif (request()->query('column') === $column && request()->query('direction') === 'asc')
        <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:mb-[2px] min-w-[8px] sm:w-[8px]'/>
        <img src="{{asset('images/arrows/down-colored.png')}}" class='sm:w-[8px] min-w-[8px]'/>
        @else
        <img src="{{asset('images/arrows/up-arrow.png')}}" class='mb-[4px] sm:mb-[2px] min-w-[8px] sm:w-[8px]'/>
        <img src="{{asset('images/arrows/down-arrow.png')}}" class='sm:w-[8px] min-w-[8px]'/>
        @endif
        </div>
    </a>
</th>