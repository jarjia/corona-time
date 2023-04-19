<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-xl mb-2 font-bold sm:text-2xl'>Welcome Back!</h2>
        <h3 class='text-md tracking-wide text-gray sm:text-lg'>Welcome back! Please enter your details</h3>
    </div>
        <form method='POST' action="{{route('login.store')}}" class='pr-16 sm:pr-2 mb-2'>
        @csrf

        <x-input :name="'username_or_email'" :type="'text'" :label="'Username'" placeholder='Enter unique username or email'/>
        <x-input :name="'password'" :type="'password'" :label="'Password'" placeholder='Fill in password'/>
        <div class='flex justify-between'>
            <div class='flex items-center gap-2 mb-2'>
                <input class="text-checkbox rounded focus:ring-0 or focus:ring-transparent"
                    type="checkbox"
                    name="remember_token"
                    id="remember_token"
                />
                <label class="font-bold block text-sm sm:text-md text-gray-700"
                    for="remember_token"
                >remember this device</label>
            </div>
            <div>
                <a href="{{route('recover.email')}}" class='text-link sm:text-[14px]'>Forgot password?</a>
            </div>
        </div>

        <button type='submit' class='mt-4 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            SIGN IN
        </button>
    </form>
    <div class='text-left sm:text-center sm:py-2'>
        <small class='text-gray text-primary-font sm:text-[14px]'>Don’t have and account? <a href="{{route('signup.create')}}" class='text-black font-bold'>Sign up for free</a></small>
    </div>
</x-layout-for-auth>