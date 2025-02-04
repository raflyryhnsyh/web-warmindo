<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Bagian Header --}}
                    <div class="top-section flex justify-between">
                        {{-- Header --}}
                        <div class="ml-8">
                            <h2
                                class="text-2xl font-semibold text-gray-800 dark:text-gray-200 border-b-2 border-gray-300 dark:border-gray-600 pb-2">
                                Tabel
                            </h2>
                        </div>
                        <div class="flex">
                            {{-- Add menu --}}
                            <button data-modal-target="add-update-tabel" data-modal-toggle="add-update-tabel"
                                id="add-btn"
                                class="mr-8 block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                Add Tabel
                            </button>
                            {{-- Update Status --}}
                            <button data-modal-target="add-update-tabel" data-modal-toggle="add-update-tabel"
                                id="update-btn"
                                class="mr-8 text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center"
                                type="button">
                                Update Tabel
                            </button>
                        </div>
                    </div>

                    {{-- Bagian Data --}}
                    <div class="card">
                        <div class="overflow-x-auto p-5">
                            {{-- pop up delete --}}
                            @include('components.pop-up-delete')
                            {{-- tabel menu --}}
                            <table class="table w-full">
                                <!-- head -->
                                <thead class="text-sm text-black text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>TABEL NUMBER</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-center">
                                    @foreach ($tabel as $data)
                                        <tr>
                                            <td>{{ $data->id_tabel }}</td>
                                            <td>{{ $data->tabel_number }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td class="flex justify-center">
                                                <button type="button"
                                                    onclick="delete_item({{ $data->id_tabel }}, '{{ route('tabel.delete') }}')"
                                                    data-modal-target="popup-delete" data-modal-toggle="popup-delete"
                                                    class="flex items-center text-xs px-3 py-2 text-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 mr-1 -ml-0.5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- container pop-up --}}
                            <div id="modal-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // add tabel
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-btn').addEventListener('click', function() {
                fetch('/tabel/add')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch modal: ' + response.status);
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Modal fetched successfully');
                        // Proses data (HTML view) dan tampilkan di modal
                        document.getElementById('modal-container').innerHTML = data;
                        console.log('Successfully');
                        const modal = document.getElementById('add-update-tabel');
                        console.log('add-update-tabel Successfully');
                        if (modal) {
                            modal.classList.remove('hidden');
                        } else {
                            console.error('Modal element not found!');
                        }
                        console.log('modal Successfully');

                        // Menangani klik untuk menutup modal
                        const closeButton = document.getElementById('close-btn');
                        closeButton.addEventListener('click', function() {
                            modal.classList.add('hidden');
                            modal.remove(); // Hapus modal setelah ditutup
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        // update tabel
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('update-btn').addEventListener('click', function() {
                console.log('Fetching modal...');
                fetch('/tabel/update', {
                        method: 'GET'
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch modal: ' + response.status);
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Modal fetched successfully');
                        // Proses data (HTML view) dan tampilkan di modal
                        document.getElementById('modal-container').innerHTML = data;
                        console.log('Successfully');
                        const modal = document.getElementById('add-update-tabel');
                        console.log('add-update-tabel Successfully');
                        if (modal) {
                            modal.classList.remove('hidden');
                        } else {
                            console.error('Modal element not found!');
                        }
                        console.log('modal Successfully');

                        // Menangani klik untuk menutup modal
                        const closeButton = document.getElementById('close-btn');
                        closeButton.addEventListener('click', function() {
                            modal.classList.add('hidden');
                            modal.remove(); // Hapus modal setelah ditutup
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        // delete tabel
        function delete_item(id, route) {
            document.getElementById('id_delete').value = id;
            document.getElementById('delete-form').action = route;
        }
    </script>
</x-app-layout>
