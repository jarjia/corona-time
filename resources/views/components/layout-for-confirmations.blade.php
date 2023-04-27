<x-layout>
    <section class='grid grid-cols-1 p-8 sm:px-4 h-full'>        
        <div class='flex justify-center sm:justify-start'>
            <img src='/images/group-1.png' class='w-[150px] h-[38px]'/>
        </div>
        <div class='flex justify-center row-span-2 py-16 sm:py-8 sm:h-full'>
            {{$slot}}
        </div>
    </section>
</x-layout>