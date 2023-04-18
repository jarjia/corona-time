<x-layout>
    <section class='grid grid-cols-2 gap-10 w-full h-full'>
            <section class='px-20 py-8'>
                <div class='mb-8'>
                    <img src='/images/Group 1.png' alt='app logo'/>
                </div>
                <div class='w-5/6'>
                    {{$slot}}
                </div>
            </section>
            <section class='h-full w-auto'>
                <img src='/images/Rectangle 1.png' class='h-full w-full' alt='background'/>
            </section>
    </section>
</x-layout>