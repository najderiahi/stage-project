<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            Creation de facture <span class="text-blue-600">{{ $client->CLIENTNAME }}</span>
        </h2>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto lg:px-8 md:px-6 grid grid-cols-1 gap-5">
        <form action="" class="flex items-end space-x-5">
            <div class="flex flex-col max-w-xs flex-shrink-0 w-full">
                <label for="" class="text-gray-700 text-sm mb-1">Mois de l'annee</label>
                <select name="month" class="w-full px-2 py-1 rounded-md shadow-none border border-gray-300">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" @if($month == $i) selected @endif>{{ \Illuminate\Support\Carbon::createFromDate(2021, $i, 1)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex flex-col max-w-xs flex-shrink-0 w-full">
                <label for="" class="text-gray-700 text-sm mb-1">Annee</label>
                <select name="year" class="w-full px-2 py-1 rounded-md shadow-none border border-gray-300">
                        @for ($i = 2012; $i <= now()->year; $i++)
                            <option value="{{ $i }}" @if($year == $i) selected @endif>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <button type="submit" class="px-3 py-2 text-xs font-semibold tracking-wide uppercase rounded-md bg-blue-700 focus:ring focus:ring-blue-300 focus:ring-opacity-50 focus:outline-none text-white">Generer facture</button>
        </form>
        @if($clientInvoices->isEmpty() && $outputs->count == 0 && $inputs->count == 0 && $facturations->isEmpty())
        <div class="flex flex-col items-center justify-center my-20 space-y-4">
                <div class="w-1/3  bg-gray-100 p-2 rounded-t-full">
                    <img src="{{ asset('assets/images/empty.svg') }}" alt="">
                </div>
                <span class="text-gray-700">Pas d'elements disponibles pour cette date.</span>
        </div>
        @endif
        <form action="{{ route('clients.invoices.store', $client) }}" method="POST">
            @csrf
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
                                <tbody x-data='{
                                    price: [],
                                    nbrEmp: @json($clientInvoice->map(fn ($value) => $value->NBR_EMP)),
                                    calculatePriceTotal () {
                                        let total = 0;
                                        for(let i =0; i < this.nbrEmp.length; i++) {
                                            if(this.nbrEmp[i] === undefined || this.price[i] === undefined) return ""
                                            total += (parseFloat(this.nbrEmp[i]) * parseFloat(this.price[i]));
                                        }
                                        return isNaN(total) ? "" : total;
                                    }
                                }' class="bg-white divide-y divide-gray-200">
                                    @foreach($clientInvoice as $index => $weekInvoice)
                                    <tr>
                                        @if($loop->first)
                                        <td class="px-6 py-4 whitespace-nowrap border-r" rowspan='{{ $clientInvoice->count() }}'>
                                            <div class="flex items-start justify-start">
                                                <div class="text-xs text-gray-700">
                                                    {{ $designation }}
                                                </div>
                                            </div>
                                            <input type="hidden" name="designations[]" value="{{ $designation }}">
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
                                                    <input x-model="price[{{$index}}]" type="number" class="px-2 py-1 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50 focus:border-gray-400 shadow-none transition" />
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
                                        <td colspan="2"></td>
                                        <td>
                                            <div class="flex items-center px-6">
                                                <div class="text-xs text-gray-700 text-xl font-semibold" x-text="calculatePriceTotal()"></div>
                                                <input type="hidden" name="total_prices_designation[]"  :value="calculatePriceTotal()">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($outputs->count != 0 || $inputs->count != 0)
            <h2 class="text-xl font-semibold mb-2 mt-4">Entrees - Sorties</h2>
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
                                        Mouvements
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Quantites
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Prix Unitaire
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                        Prix Total
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" x-data="{
                                    inputPrice: null,
                                    inputQty: {{ $inputs->count}},
                                    outputPrice: null,
                                    outputQty: {{$outputs->count}},
                                    calculateInputTotal () {
                                        let total = parseFloat(this.inputQty) * parseFloat(this.inputPrice);
                                        return isNaN(total) ? '': total;
                                    },
                                    calculateOutputTotal () {
                                        let total = parseFloat(this.outputQty) * parseFloat(this.outputPrice);
                                        return isNaN(total) ? '' : total;
                                    },
                                    priceTotal () {
                                        let total = this.calculateInputTotal() + this.calculateOutputTotal();
                                        return isNaN(total) ? '' : total;
                                    }
                                }">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-r" rowspan='2'>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    Entrees
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    {{ $inputs->count }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    <input x-model="inputPrice" type="number" class="px-2 py-1 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50 focus:border-gray-400 shadow-none transition" />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700" x-text="calculateInputTotal()">
                                                </div>
                                                <input type="hidden" name="inputs_price" :value="calculateInputTotal()">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    Sorties
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    {{ $outputs->count }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    <input x-model="outputPrice" type="number" class="px-2 py-1 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50 focus:border-gray-400 shadow-none transition" />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700" x-text="calculateOutputTotal()">
                                                </div>
                                                <input type="hidden" name="outputs_price" :value="calculateOutputTotal()">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-r">
                                            <div class="flex items-center">
                                                <div class="text-xs text-gray-700">
                                                    Prix total
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2"></td>
                                        <td>
                                            <div class="flex items-center px-6">
                                                <div class="text-xs text-gray-700 text-xl font-semibold" x-text="priceTotal()">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($facturations->isNotEmpty())
            <h2 class="text-xl font-semibold mb-2 mt-4">Facturations</h2>
            <div class="flex flex-col">
                <div class="-my-2 sm:-mx-6 lg:-mx-8">
                    <div id="facturation-management" data-facturations='@json($facturations)'></div>
                </div>
            </div>
            @endif
            <button type="submit" class="px-3 py-2 text-sm uppercase font-semibold tracking-wide bg-blue-700 text-white rounded-md hover:bg-blue-600 border border-blue-700 transition duration-300 my-4">Valider la facture</button>
        </form>
    </div>
</x-app-layout>
