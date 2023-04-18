<x-layout-for-auth>
    <div class='mb-6'>
        <h2 class='text-2xl mb-2 font-bold'>Welcome to Coronatime</h2>
        <h3 class='text-lg tracking-wide text-gray'>Please enter required info to sign up</h3>
    </div>
        <form method='POST' action="{{route('login.store')}}" class='pr-16 mb-2'>
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
                <label class="font-bold block text-md text-gray-700"
                    for="remember_token"
                >remember this device</label>
            </div>
            <div>
                <a href="{{route('recover.email')}}" class='text-link'>Forgot password?</a>
            </div>
        </div>

        <button type='submit' class='mt-4 w-full bg-sign-up-btn tracking-wide text-white py-4 rounded-md'>
            SIGN IN
        </button>
    </form>
    <div>
        <small class='text-gray text-primary-font'>Don’t have and account? <a href="{{route('signup.create')}}" class='text-black font-bold'>Sign up for free</a></small>
    </div>
</x-layout-for-auth>