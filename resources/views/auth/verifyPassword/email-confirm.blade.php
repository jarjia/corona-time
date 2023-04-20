<x-layout-for-confirmations>
    <div class='w-1/4 sm:w-full'>
        <div class='mb-8 sm:mb-4 text-center relative sm:bottom-[50px]'>
            <h2 class='text-2xl mb-2 font-bold'>Reset Password</h2>
        </div>
        <form method='POST' action="{{route('recover.send')}}" class='block sm:flex sm:flex-col sm:justify-between sm:h-full'>
        @csrf

        <div class='relative sm:bottom-[50px]'>
            <x-input :name="'email'" :type="'email'" :label="'Email'" placeholder='Enter Your email'/>
        </div>

        <button type='submit' class='mt-2 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            RESET PASSWORD
        </button>
        </form>
    </div>
</x-layout-for-confirmations>