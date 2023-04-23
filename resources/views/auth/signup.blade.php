<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-xl mb-2 font-bold sm:text-2xl'>{{__('forms.welcome_to_corona_time')}}</h2>
        <h3 class='text-md tracking-wide text-gray sm:text-lg'>{{__('forms.register_desc')}}</h3>
    </div>
    <form method='POST' action="{{route('signup.store')}}" class='pr-20 sm:pr-2 mb-2'>
        @csrf

        <x-input :name="'name'" :type="'text'" :label="__('inputs.username')" :placeholder="__('inputs.username_placeholder')"/>
        <x-input :name="'email'" :type="'email'" :label="__('inputs.email')" :placeholder="__('inputs.email_placeholder')"/>
        <x-input :name="'password'" :type="'password'" :label="__('inputs.password')" :placeholder="__('inputs.password_placeholder')"/>
        <x-input :name="'password_confirmation'" :type="'password'" :label="__('inputs.confirm_password')" :placeholder="__('inputs.confirm_password_placeholder')"/>

        <button type='submit' class='mt-4 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.sign_up')}}
        </button>
    </form>
    <div class='text-left sm:text-center sm:py-2'>
        <small class='text-gray text-primary-font sm:text-[14px]'>{{__('forms.have_acc')}} <a href="{{route('login.create')}}" class='text-black font-bold'>{{__('forms.log_in_link')}}</a></small>
    </div>
</x-layout-for-auth>