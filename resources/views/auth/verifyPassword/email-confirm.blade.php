<x-layout-for-confirmations>
    <div class='w-1/4'>
        <div class='mb-8 text-center'>
            <h2 class='text-2xl mb-2 font-bold'>Reset Password</h2>
        </div>
        <form method='POST' action="{{route('recover.send')}}">
        @csrf

        <x-input :name="'email'" :type="'email'" :label="'Email'" placeholder='Enter Your email'/>

        <button type='submit' class='mt-2 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            RESET PASSWORD
        </button>
        </form>
    </div>
</x-layout-for-confirmations>