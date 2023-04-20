<x-layout>
    <section class='grid grid-cols-session sm:flex sm:w-full sm:gap-2 gap-10 w-full h-full'>
            <section class='px-20 py-8 sm:px-4 sm:w-full sm:py-4'>
                <div class='mb-8'>
                    <img src='/images/Group 1.png' alt='app logo'/>
                </div>
                <div class='w-5/6 sm:w-full'>
                    {{$slot}}
                </div>
            </section>
            <section class='h-full block sm:hidden w-auto'>
                <img src='/images/Rectangle 1.png' class='h-full w-full' alt='background'/>
            </section>
    </section>
</x-layout>