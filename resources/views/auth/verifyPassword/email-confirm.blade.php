<x-layout-for-confirmations>
    <div class='w-1/4 sm:w-full'>
        <div class='mb-8 sm:mb-4 text-center relative sm:bottom-[50px]'>
            <h2 class='text-2xl mb-2 font-bold'>{{__('forms.reser_password')}}</h2>
        </div>
        <form method='POST' action="{{route('recover.send')}}" class='block sm:flex sm:flex-col sm:justify-between sm:h-full' novalidate>
        @csrf

        <div class='relative sm:bottom-[50px]'>
            <x-input :name="'email'" :type="'email'" :label="__('inputs.email')" :placeholder="__('inputs.email_placeholder')"/>
        </div>

        <button type='submit' class='mt-2 w-full font-[900] bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            {{__('forms.reset_password_big')}}
        </button>
        </form>
    </div>
</x-layout-for-confirmations>