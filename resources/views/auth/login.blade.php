<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-xl text-[#010414] mb-2 font-bold sm:text-2xl'>{{__('forms.welcome_back')}}</h2>
        <h3 class='text-md text-[#808189] tracking-wide text-gray sm:text-lg'>{{__('forms.login_desc')}}</h3>
    </div>
        <form method='POST' action="{{route('login.store')}}" class='pr-48 sm:pr-2 mb-2' novalidate>
        @csrf

        <x-input :name="'username_or_email'" :type="'text'" :label="__('inputs.username')" :placeholder="__('inputs.username_placeholder')"/>
        <x-input :name="'password'" :type="'password'" :label="__('inputs.password')" :placeholder="__('inputs.password_placeholder')"/>
        <div class='flex justify-between'>
            <div class='flex items-center gap-2 mb-2'>
                <input class="text-checkbox focus:text-[#249E2C] hover:text-[#249E2C] rounded focus:ring-0 or focus:ring-transparent"
                    type="checkbox"
                    name="remember_token"
                    id="remember_token"
                />
                <label class="font-bold block text-sm sm:text-md text-gray-700"
                    for="remember_token"
                >{{__('inputs.checkbox')}}</label>
            </div>
            <div>
                <a href="{{route('recover.email')}}" class='text-link sm:text-[14px]'>{{__('forms.forgot_password')}}</a>
            </div>
        </div>

        <button type='submit' class='mt-4 font-[900] w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.log_in')}}
        </button>
    </form>
    <div class='text-center sm:text-center sm:py-2 pr-48'>
        <small class='text-gray text-primary-font sm:text-[14px]'>{{__('forms.have_not_acc')}} <a href="{{route('signup.create')}}" class='text-black font-bold'>{{__('forms.Sign_up_for_free')}}</a></small>
    </div>
</x-layout-for-auth>