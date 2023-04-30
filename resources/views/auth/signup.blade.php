<x-layout-for-auth>
    <div class='mb-2'>
        <h2 class='text-xl text-[#010414] mb-1 font-bold sm:text-2xl'>{{__('forms.welcome_to_corona_time')}}</h2>
        <h3 class='text-md text-[#808189] tracking-wide text-gray sm:text-lg'>{{__('forms.register_desc')}}</h3>
    </div>
    <form method='POST' action="{{route('signup.store')}}" class='w-[420px] sm:w-full sm:pr-2' novalidate>
        @csrf

        <x-input :name="'name'" :type="'text'" :label="__('inputs.username')" :placeholder="__('inputs.username_placeholder')"/>
        <x-input :name="'email'" :type="'email'" :label="__('inputs.email')" :placeholder="__('inputs.email_placeholder')"/>
        <x-input :name="'password'" :type="'password'" :label="__('inputs.password')" :placeholder="__('inputs.password_placeholder')"/>
        <x-input :name="'password_confirmation'" :type="'password'" :label="__('inputs.confirm_password')" :placeholder="__('inputs.confirm_password_placeholder')"/>

        <button type='submit' class='w-full font-[900] bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.sign_up')}}
        </button>
        <div class='text-center sm:text-center sm:py-2'>
            <small class='text-gray text-primary-font sm:text-[14px]'>{{__('forms.have_acc')}} <a href="{{route('login.create')}}" class='text-black font-bold'>{{__('forms.log_in_link')}}</a></small>
        </div>
    </form>
</x-layout-for-auth>