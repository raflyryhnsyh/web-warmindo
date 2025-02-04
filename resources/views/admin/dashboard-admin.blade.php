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
                                Menu
                            </h2>
                        </div>
                        {{-- Add menu --}}
                        <button data-modal-target="add-edit-menu" data-modal-toggle="add-edit-menu" id="add-btn"
                            class="mr-8 block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Add Menu
                        </button>
                    </div>

                    {{-- Bagian Data --}}
                    <div class="card">
                        <div class="overflow-x-auto p-5">
                            {{-- pop up delete --}}
                            @include('components.pop-up-delete')
                            {{-- tabel menu --}}
                            <table class="table w-full">
                                <!-- head -->
                                <thead class="text-sm text-black">
                                    <tr>
                                        <th>ID</th>
                                        <th>MENU NAME</th>
                                        <th>PRICE</th>
                                        <th>DESCRIPTION</th>
                                        <th>CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600">
                                    @foreach ($data as $menu)
                                        <tr>
                                            <td>{{ $menu->id_menu }}</td>
                                            <td>{{ $menu->menu_name }}</td>
                                            <td>{{ $menu->price }}</td>
                                            <td>{{ $menu->description }}</td>
                                            <td>{{ $menu->category->category_name }}</td>
                                            <td>{{ $menu->status }}</td>
                                            <td>
                                                <button type="button" data-modal-target="add-edit-menu"
                                                    data-modal-toggle="add-edit-menu" data-id_menu="{{ $menu->id_menu }}"
                                                    data-menu_name="{{ $menu->menu_name }}"
                                                    data-price="{{ $menu->price }}"
                                                    data-description="{{ $menu->description }}"
                                                    data-category="{{ $menu->category->category_name }}"
                                                    data-status="{{ $menu->status }}"
                                                    class="edit-btn flex items-center text-xs px-5 py-2 text-center font-medium rounded-lg text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 mr-1 -ml-0.5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" onclick="delete_item({{ $menu->id_menu }}, '{{ route('menu.delete') }}')"
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
        // add menu
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-btn').addEventListener('click', function() {
                fetch('/menu/add')
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
                        const modal = document.getElementById('add-edit-menu');
                        console.log('add-edit-menu Successfully');
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

        // edit menu
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('table').addEventListener('click', function(event) {
                if (event.target.classList.contains('edit-btn')) {
                    // Mengambil data dari atribut data-*
                    const button = event.target;
                    const id_menu = button.getAttribute('data-id_menu');
                    const menu_name = button.getAttribute('data-menu_name');
                    const price = button.getAttribute('data-price');
                    const description = button.getAttribute('data-description');
                    const category = button.getAttribute('data-category');
                    const status = button.getAttribute('data-status');

                    // Fetch form update dari server
                    fetch(`/menu/update/${id_menu}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to fetch modal: ' + response.status);
                            }
                            return response.text();
                        })
                        .then(data => {
                            // Masukkan form ke dalam modal-container
                            document.getElementById('modal-container').innerHTML = data;
                            const modal = document.getElementById('add-edit-menu');

                            if (modal) {
                                // Tampilkan modal
                                modal.classList.remove('hidden');

                                // Isi data ke dalam form di modal
                                document.getElementById('menu_name').value = menu_name;
                                document.getElementById('price').value = price;
                                document.getElementById('description').value = description;

                                // Pilih category sesuai dengan data
                                const categorySelect = document.getElementById('id_category');
                                if (categorySelect) {
                                    Array.from(categorySelect.options).forEach(option => {
                                        option.selected = option.value === category;
                                    });
                                }

                                // Pilih status sesuai dengan data
                                const statusSelect = document.getElementById('status');
                                if (statusSelect) {
                                    Array.from(statusSelect.options).forEach(option => {
                                        option.selected = option.value === status;
                                    });
                                }

                                // Atur form action ke route update dengan ID menu
                                const form = modal.querySelector('form');
                                form.action = `/menu/update/${id_menu}`;

                                // Tambahkan input hidden untuk method PUT
                                let methodInput = form.querySelector('input[name="_method"]');
                                if (!methodInput) {
                                    methodInput = document.createElement('input');
                                    methodInput.type = 'hidden';
                                    methodInput.name = '_method';
                                    methodInput.value = 'PUT';
                                    form.appendChild(methodInput);
                                }

                                // Ubah teks tombol submit menjadi "Update Menu"
                                form.querySelector('button[type="submit"]').innerHTML = `
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Update Menu`;

                                // Menangani klik untuk menutup modal
                                const closeButton = document.getElementById('close-btn');
                                closeButton.addEventListener('click', function() {
                                    modal.classList.add('hidden');
                                    modal.remove(); // Hapus modal setelah ditutup
                                });
                            } else {
                                console.error('Modal element not found!');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });

        // delete menu
        function delete_item(id, route) {
            document.getElementById('id_delete').value = id;
            document.getElementById('delete-form').action = route;
        }
    </script>
</x-app-layout>
