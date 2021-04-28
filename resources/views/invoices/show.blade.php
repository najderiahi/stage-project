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
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Identifiant
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Designation
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Semaine
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Emplacement
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Produit
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Quantite
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clientProducts as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-500">
                                                {{ $product->ROWID }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $product->COMMENT_IN }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $product->BINLABEL }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $product->PRODUCT }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-700">
                                                {{ $product->QUANTITY }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="flex flex-col space-y-4 items-center justify-center my-6">
                                            <div class="bg-gray-100 rounded-full">
                                                <img
                                                    src="{{ asset('assets/images/empty.svg') }}"
                                                    alt=""
                                                    class="h-64 w-64"
                                                >
                                            </div>
                                            <h4 class="text-sm text-gray-500">Pas d'elements correspondant</h4>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
