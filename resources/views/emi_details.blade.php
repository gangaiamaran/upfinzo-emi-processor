<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('EMI Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="emiDetailsApp()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 flex items-center justify-center">
                <button @click="processData" :disabled="loading" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 mr-2 rounded-full">
                    Process Data
                    <!-- Spinner -->
                    <svg x-show="loading" class="inline-block ml-2 w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0115.19-4.09A4.5 4.5 0 0012 8v4a4.5 4.5 0 001.81 8.09A8 8 0 014 12z"></path>
                    </svg>
                </button>
                <button class="bg-amber-100 hover:bg-amber-300 text-black font-bold py-2 px-4 rounded-full" @click="clearData">Clear Data</button>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-show="showTable">
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <div>
                                        <p x-text="message"></p>
                                        <table x-show="showTable" class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <template x-for="key in emiKeys" :key="key">
                                                <th scope="col" class="px-6 py-3 text-left text-sm border-b font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    <span x-text="key"></span>
                                                </th>
                                            </template>

                                        </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        <template x-for="item in emiDetails" :key="item.id">
                                            <tr>
                                                <template x-for="key in emiKeys" :key="key">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        <span x-text="item[key]"></span>
                                                    </td>
                                                </template>
                                            </tr>
                                        </template>
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
    </div>
</x-app-layout>
<script>
    function emiDetailsApp() {
        return {
            message: '',
            emiDetails: [],
            emiKeys: [],
            showTable: false,
            loading: false,
            processData() {
                this.loading = true;
                fetch('/emi-details/process-data', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        this.message = data.message;
                        this.emiDetails = data.value.data;
                        this.emiKeys = data.columns;
                        this.showTable = true;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.message = 'An error occurred while processing data.';
                        this.showTable = false;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            clearData() {
                this.showTable = false;
            }
        }
    }
</script>
