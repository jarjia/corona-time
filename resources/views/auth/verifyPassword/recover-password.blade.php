<x-layout-for-confirmations>
    <div class='w-1/4 sm:w-full'>
        <div class='mb-8 sm:mb-4 text-center relative sm:bottom-[50px]'>
            <h2 class='text-2xl mb-2 font-bold'>Reset Password</h2>
        </div>
        <form method='POST' action="{{route('recover.password.reset')}}" class='block sm:flex sm:flex-col sm:justify-between sm:h-full'>
        @csrf

        <div class='relative sm:bottom-[50px]'>
            <input type='hidden' name='email' value="{{$email}}"/>
            <input type='hidden' name='token' value="{{$token}}"/>
            <x-input :name="'password'" :type="'password'" :label="'New Password'" placeholder='Enter New Password'/>
            <x-input :name="'password_confirmation'" :type="'password'" :label="'Repeat Password'" placeholder='Repeat password'/>
        </div>

        <button type='submit' class='mt-2 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            SAVE CHANGES
        </button>
        </form>
    </div>
</x-layout-for-confirmations>