<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-8080 text-center leading-tight">
            Creation de facture <span class="text-indigo-600">{{ $client->CLIENTNAME }}</span>
        </h2>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto lg:px-8 md:px-6 grid grid-cols-1 gap-5">
        <form action="" class="flex items-end space-x-5">
            <div class="flex flex-col max-w-xs flex-shrink-0 w-full">
                <label for="" class="text-gray-700 text-sm mb-1">Mois de l'annee</label>
                <select name="month" id="" class="w-full px-2 py-1 rounded-md shadow-none border border-gray-300">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" @if($month == $i) selected @endif>{{ \Illuminate\Support\Carbon::createFromDate(2021, $i, 1)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex flex-col max-w-xs flex-shrink-0 w-full">
                <label for="" class="text-gray-700 text-sm mb-1">Annee</label>
                <select name="year" id="" class="w-full px-2 py-1 rounded-md shadow-none border border-gray-300">
                        @for ($i = 2012; $i <= now()->year; $i++)
                            <option value="{{ $i }}" @if($year == $i) selected @endif>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <button type="submit" class="px-3 py-2 text-xs font-semibold tracking-wide uppercase rounded-md bg-gray-800 focus:ring focus:ring-gray-300 focus:ring-opacity-50 focus:outline-none text-white">Generer facture</button>
        </form>
        @foreach($clientInvoices as $designation => $clientInvoice)
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Tarif
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($clientInvoice as $weekInvoice)
                                <tr>
                                    @if($loop->first)
                                    <td class="px-6 py-4 whitespace-nowrap border-r" rowspan='{{ $clientInvoice->count() }}'>
                                        <div class="flex items-start justify-start">
                                            <div class="text-xs text-gray-700">
                                                {{ $designation }}
                                            </div>
                                        </div>
                                    </td>
                                    @endif
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                <input type="number" class="px-2 py-1 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50 focus:border-gray-400 shadow-none transition" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-r">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                Prix total
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
