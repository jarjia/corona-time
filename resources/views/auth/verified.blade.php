@props(['message', 'redirect'])
<x-layout-for-confirmations>
    <div class='flex flex-col'>
        <div class='flex justify-center'>
            <img src="{{ asset('gifs/icons8-checkmark.gif') }}">
        </div>
        <span class='text-[18px]'>{{$message}}</span>
        <a href="{{route($redirect)}}" class='mt-16 text-center bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            SIGN IN
        </a>
    </div>
</x-layout-for-confirmations>