<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-8080 leading-tight">
			{{ __('Client "John Doe" ') }}
		</h2>
	</x-slot>

	<div class="py-12 max-w-7xl mx-auto">
		<div class="bg-white lg:rounded-md shadow-sm">
			<div class="grid md:grid-cols-4 mt-8 px-8 py-8 md:divide-x divide-y
				md:divide-y-0">
				<div class="flex items-center justify-center py-4 lg:w-48">
					<div class="bg-indigo-500 p-2 rounded-md">
						<span class="text-white">
							<svg class="w-6 h-6" fill="none"
								stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round"
								stroke-width="2" d="M12 11c0 3.517-1.009
								6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916
								13.916 0 008 11a4 4 0 118 0c0 1.017-.07
								2.019-.203 3m-2.118 6.844A21.88 21.88 0
								0015.171 17m3.839
								1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008
								4.07M3 15.364c.64-1.319 1-2.8 1-4.364
								0-1.457.39-2.823 1.07-4"></path></svg>
						</span>
					</div>
					<div class="flex flex-col px-4">
						<span class="text-gray-600">Identifiant</span>
						<span class="text-xl text-gray-800 font-semibold
							truncate"> 7EBE02EC</span>
					</div>
				</div>
				<div class="flex items-center justify-center py-4 lg:w-48">
					<div class="bg-indigo-500 p-2 rounded-md">
						<span class="text-white">
							<svg class="w-6 h-6" fill="none"
								stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round"
								stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0
								018 0zM12 14a7 7 0 00-7 7h14a7 7 0
								00-7-7z"></path></svg>
						</span>
					</div><div class="flex flex-col px-4">
						<span class="text-gray-600">Nom</span>
						<span class="text-xl text-gray-800 font-semibold">John Doe</span>
					</div>
				</div>
				<div class="flex items-center justify-center py-4 lg:w-48">
					<div class="bg-indigo-500 p-2 rounded-md">
						<span class="text-white">
							<svg class="w-6 h-6" fill="none"
								stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round"
								stroke-width="2" d="M17 20h5v-2a3 3 0
								00-5.356-1.857M17 20H7m10
								0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3
								0 015.356-1.857M7
								20v-2c0-.656.126-1.283.356-1.857m0 0a5.002
								5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016
								0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0
												 11-4 0 2 2 0 014
												 0z"></path></svg>
						</span>
					</div><div class="flex flex-col px-4">
						<span class="text-gray-600">Groupe</span>
						<span class="text-xl text-gray-800 font-semibold">3PL</span>
					</div>
				</div>
				<div class="flex items-center justify-center py-4 lg:w-48">
					<div class="bg-indigo-500 p-2 rounded-md">
						<span class="text-white">
							<svg class="w-6 h-6" fill="none"
								stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round"
								stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2
								4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2
								2v12a2 2 0 002 2z"></path></svg>
						</span>
					</div><div class="flex flex-col px-4">
						<span class="text-gray-600">Nombre</span>
						<span class="text-xl text-gray-800 font-semibold">KL</span>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white lg:rounded-md shadow-sm mt-8">
			<div class="flex justify-between px-8 pt-6 pb-6 items-center">
				<h2 class="text-xl font-semibold text-gray-u800">
					Factures du client
				</h2>
				<button class="px-3 py-2 bg-indigo-700 rounded inline-flex
					text-indigo-50">
					<svg class="w-6 h-6 text-indigo-100" fill="none" stroke="currentColor"
						viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg"><path
						stroke-linecap="round" stroke-linejoin="round"
						stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6
						0H6"></path></svg>
					Nouvelle facture
				</button>
			</div>
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
						<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200">
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Nom de la facture
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Date de delivrance
										</th>
										<th scope="col" class="relative px-6 py-3">
											<span class="sr-only">Actions</span>
										</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<div class="text-sm font-medium text-gray-900">
													Facture #1
												</div>
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="text-sm
														text-gray-500">12/04/1994</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
											<a href="#" class="text-indigo-600
													 hover:text-indigo-900
													 font-medium">Visualiser</a>
										</td>
									</tr>
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<div class="text-sm font-medium text-gray-900">
													Facture #2
												</div>
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="text-sm
														text-gray-500">12/04/2020</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
											<a href="#" class="text-yellow-600
													 hover:text-yellow-900
													 font-medium">Poursuivre création</a>
										</td>
									</tr>
									<!-- More people... -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</x-app-layout>
