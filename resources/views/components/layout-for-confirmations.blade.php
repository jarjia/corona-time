<x-layout>
    <section class='grid grid-cols-1 p-8 h-full'>        
        <div class='flex justify-center'>
            <img src='/images/Group 1.png' class='w-[150px] h-[38px]'/>
        </div>
        <div class='flex justify-center row-span-2 py-16'>
            {{$slot}}
        </div>
    </section>
</x-layout>