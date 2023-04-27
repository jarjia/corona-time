<x-layout-for-auth>
    <div class='mb-2'>
        <h2 class='text-xl text-[#010414] mb-1 font-bold sm:text-2xl'>{{__('forms.welcome_to_corona_time')}}</h2>
        <h3 class='text-md text-[#808189] tracking-wide text-gray sm:text-lg'>{{__('forms.register_desc')}}</h3>
    </div>
    <form method='POST' action="{{route('signup.store')}}" class='pr-48 sm:pr-2' novalidate>
        @csrf

        <x-input :name="'name'" :type="'text'" :label="__('inputs.username')" :placeholder="__('inputs.username_placeholder')"/>
        <x-input :name="'email'" :type="'email'" :label="__('inputs.email')" :placeholder="__('inputs.email_placeholder')"/>
        <x-input :name="'password'" :type="'password'" :label="__('inputs.password')" :placeholder="__('inputs.password_placeholder')"/>
        <div class='mb-10'>
            <label class="font-bold block mb-[6px] text-md text-[#010414]"
                for="password_confirmation"
            >{{__('inputs.confirm_password')}}</label>
            <input class="form-input {{!$errors->has('password') && old('password') !== null ? 'border-success' : ''}} 
            {{$errors->has('password') ? 'border-error' : ''}} border-[#E6E6E7] rounded-md px-4 py-3 w-full"
                type="password"
                name="password_confirmation"
                value="{{old("password_confirmation")}}"
                placeholder="{{__('inputs.confirm_password_placeholder')}}"
                id="password_confirmation"
            >
            @if (!$errors->has('password_confirmation') && old('') !== null)
                <img src='/images/vector.png' class='w-[20px] h-[20px] float-right relative bottom-9 right-4' alt='success icon'/>
            @endif
            @error("password")
                    @if ($message = "password does not match to password.")
                        <div class='flex absolute gap-2 mt-2'>
                            <img src='/images/vector-(9).png' class='w-[20px] h-[20px]' alt='error icon'/>
                            <div class='text-error text-sm'>{{ $message }}</div>
                        </div>
                    @endif
            @enderror
        </div>
        <button type='submit' class='w-full font-[900] bg-sign-up-btn tracking-wide text-white py-3 rounded-md'>
            {{__('forms.sign_up')}}
        </button>
    </form>
    <div class='text-center sm:text-center sm:py-2 pr-48'>
        <small class='text-gray text-primary-font sm:text-[14px]'>{{__('forms.have_acc')}} <a href="{{route('login.create')}}" class='text-black font-bold'>{{__('forms.log_in_link')}}</a></small>
    </div>
</x-layout-for-auth>