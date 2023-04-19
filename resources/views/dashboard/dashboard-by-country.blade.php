<x-layout-for-dashboard>
    <section class='py-10'>
        <section class='sm:px-1'>
            <form method='GET' action='#'>
                <div class="relative rounded-md">
                    <input type="email" name="email" id="email" 
                        class="rounded-[8px] py-4 px-32 block sm:w-full outline-none sm:border-0 border-[1px] border-[#E6E6E7] pl-10 sm:text-sm sm:leading-5"
                        placeholder="Search by country"
                        autocomplete='off'
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{asset('images/search.png')}}"/>
                    </div>
                </div>
            </form>
        </section>
        <section class='mt-12 sm:mt-4'>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm sm:text-[10px] text-left">
                    <thead class="text-xs sm:text-[11px] bg-[#F6F6F7] dark:bg-gray-700 text-black">
                        <tr>
                            <th scope="col" class="px-6 py-3 sm:px-2">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3 sm:px-2">
                                New cases
                            </th>
                            <th scope="col" class="px-6 py-3 sm:px-2">
                                Deaths
                            </th>
                            <th scope="col" class="px-6 py-3 sm:px-2">
                                Recovered
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-[#F6F6F7] dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 sm:px-2 font-medium text-black whitespace-nowrap">
                                Worldwide
                            </th>
                            <td class="px-6 py-4 sm:px-2">
                                9,704,000
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                5,803,905
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-[#F6F6F7] dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 sm:px-2 font-medium text-black whitespace-nowrap">
                                United States of America
                            </th>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                -
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-[#F6F6F7] dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 sm:px-2 font-medium text-black whitespace-nowrap">
                                Uruguay
                            </th>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                            <td class="px-6 py-4 sm:px-2">
                                66,591
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </section>
</x-layout-for-dashboard>