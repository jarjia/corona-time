@props(['message', 'redirect'])
<x-layout-for-confirmations>
    <div class='flex flex-col justify-center sm:justify-between'>
        <div class='sm:pt-8'>
            <div class='flex justify-center'>
                <img src="{{ asset('gifs/icons8-checkmark.gif') }}">
            </div>
            <div class='text-center'>
                <span class='text-[18px] text-center sm:text-[16px]'>{{__($message)}}</span>
            </div>
        </div>
        <a href="{{route($redirect)}}" class='mt-16 text-center bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.log_in')}}
        </a>
    </div>
</x-layout-for-confirmations>