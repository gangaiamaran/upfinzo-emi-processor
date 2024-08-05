<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loan Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Client ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Number of payment
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                First payment date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Last payment date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Loan amount
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse($loan_details as $loanDetail)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $loanDetail->client_id }}
                                                </td>
                                                <td class="px-6 py-4 font-bold whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $loanDetail->num_of_payment }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $loanDetail->first_payment_date }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $loanDetail->last_payment_date }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $loanDetail->loan_amount }}
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="px-4 py-2 border-b text-center text-gray-500 dark:text-gray-300">No data found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center mb-2">
        <a href="{{ route('emi.details') }}" class="bg-sky-300 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded-full">
            Emi Details
        </a>
    </div>
</x-app-layout>
