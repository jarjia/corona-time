@props(['name', 'label', 'type', 'placeholder'])
<div class='mb-10'>
    <label class="font-bold block mb-2 text-md text-gray-700"
        for="{{$name}}"
    >{{$label}}</label>
    <input class="form-input {{!$errors->has($name) && old($name) !== null ? 'border-success' : ''}} 
    {{$errors->has($name) ? 'border-error' : ''}} rounded-md px-4 py-3 w-full"
        type="{{$type}}"
        name="{{$name}}"
        value="{{old("$name")}}"
        placeholder="{{$placeholder}}"
        id="{{$name}}"
    >
    @if (!$errors->has($name) && old($name) !== null)
        <img src='/images/Vector.png' class='w-[20px] h-[20px] float-right relative bottom-9 right-4' alt='success icon'/>
    @endif
    @error("$name")
        <div class='flex absolute gap-2 mt-2'>
            <img src='/images/Vector (9).png' class='w-[20px] h-[20px]' alt='error icon'/>
            <div class='text-error text-sm'>{{ $message }}</div>
        </div>
    @enderror
</div>