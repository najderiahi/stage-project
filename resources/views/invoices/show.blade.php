<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-8080 text-center leading-tight">
            Creation de facture <span class="text-indigo-600">{{ $client->CUST_NAME }}</span>
        </h2>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto lg:px-8 md:px-6">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @foreach($clientInvoices as $designation => $clientInvoice)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Designation
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Semaines
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Nombre d'Emplacements
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($clientInvoice as $weekInvoice)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" rowspan='4'>
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $designation }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $weekInvoice->SEMAINE }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $weekInvoice->NBR_EMP }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
