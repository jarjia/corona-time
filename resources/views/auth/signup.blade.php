<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-xl mb-2 font-bold sm:text-2xl'>Welcome to Coronatime</h2>
        <h3 class='text-md tracking-wide text-gray sm:text-lg'>Please enter required info to sign up</h3>
    </div>
    <form method='POST' action="{{route('signup.store')}}" class='pr-16 sm:pr-2 mb-2'>
        @csrf

        <x-input :name="'name'" :type="'text'" :label="'Username'" placeholder='Enter unique username'/>
        <x-input :name="'email'" :type="'email'" :label="'Email'" placeholder='Enter your email'/>
        <x-input :name="'password'" :type="'password'" :label="'Password'" placeholder='Fill in password'/>
        <x-input :name="'password_confirmation'" :type="'password'" :label="'Repeat Password'" placeholder='Repeat password'/>

        <button type='submit' class='mt-4 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            SIGN UP
        </button>
    </form>
    <div class='text-left sm:text-center sm:py-2'>
        <small class='text-gray text-primary-font sm:text-[14px]'>Already have an account? <a href="{{route('login.create')}}" class='text-black font-bold'>Log in</a></small>
    </div>
</x-layout-for-auth>