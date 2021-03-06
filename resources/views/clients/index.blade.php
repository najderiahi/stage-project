<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
            {{ __('Liste des clients') }}
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
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Identifiant
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Groupe
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Visualiser</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-500">
                                                {{ $customer->ROWID }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $customer->CLIENTNAME }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $customer->CUSTGROUP }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
										<span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
											{{ $customer->CUST_NUM }}
										</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('clients.show', $customer->ROWID) }}"
                                           class="text-indigo-600 hover:text-indigo-900">Voir Factures</a>
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
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
