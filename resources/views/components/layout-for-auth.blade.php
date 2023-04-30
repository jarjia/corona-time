<x-layout>
    <section class='grid grid-cols-session sm:flex sm:w-full sm:gap-2 w-full h-full'>
            <section class='pl-20 pr-16 py-4 sm:px-4 sm:w-full sm:py-2'>
                <div class='mb-6 flex items-center justify-between w-[420px]'>
                    <div>
                        <img src='/images/group-1.png' alt='app logo'/>
                    </div>
                    <x-drop-down />
                </div>
                <div class='w-full sm:w-full'>
                    {{$slot}}
                </div>
            </section>
            <section class="mediumHeight:h-full h-screen block sm:hidden w-auto">
                <img src='/images/rectangle-1.png' class='h-full max-h-full w-full' alt='background'/>
            </section>
    </section>
</x-layout>