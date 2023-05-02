<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-xl text-[#010414] mb-1 2xl:mb-2 font-bold sm:text-2xl 2xl:text-[30px]'>{{__('forms.welcome_back')}}</h2>
        <h3 class='text-md text-[#808189] tracking-wide text-gray sm:text-lg 2xl:text-[24px]'>{{__('forms.login_desc')}}</h3>
    </div>
        <form method='POST' action="{{route('login.store')}}" class='w-[420px] 2xl:mt-8 2xl:w-[460px] sm:w-full sm:pr-2' novalidate>
        @csrf

        <x-input :name="'username_or_email'" :type="'text'" :label="__('inputs.username')" :placeholder="__('inputs.username_placeholder')"/>
        <x-input :name="'password'" :type="'password'" :label="__('inputs.password')" :placeholder="__('inputs.password_placeholder')"/>
        <div class='flex justify-between'>
            <div class='flex items-center gap-2 mb-2'>
                <input class="text-checkbox text-[#249E2C] rounded focus:ring-0 or focus:ring-transparent"
                    type="checkbox"
                    name="remember_token"
                    id="remember_token"
                />
                <label class="font-bold block text-sm sm:text-[12px] 2xl:text-[16px] text-gray-700"
                    for="remember_token"
                >{{__('inputs.checkbox')}}</label>
            </div>
            <div>
                <a href="{{route('recover.email')}}" class='text-link sm:text-[12px] 2xl:text-[16px]'>{{__('forms.forgot_password')}}</a>
            </div>
        </div>

        <button type='submit' class='mt-4 sm:mt-2 font-[900] 2xl:text-[20px] w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.log_in')}}
        </button>
        <div class='text-center sm:text-center sm:py-2'>
            <small class='text-gray text-primary-font sm:text-[14px] 2xl:text-[20px]'>{{__('forms.have_not_acc')}} <a href="{{route('signup.create')}}" class='text-black font-bold'>{{__('forms.Sign_up_for_free')}}</a></small>
        </div>
    </form>
</x-layout-for-auth>