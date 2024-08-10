@extends('main')
@section('main-container')
    @if(session('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Info</p>
                    <p class="text-sm">{{session('message')}}</p>
                </div>
            </div>
        </div>
    @endif
    @csrf
    <header>
        <div class="max-w-screen-xl px-4 pt-8 sm:pt-12">
            <div class="flex flex-col items-start gap-4 md:items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Pengguna</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Daftar Pengguna Internet Desa Sukamurni.
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <button>
                        <a class="group relative inline-block overflow-hidden rounded-md border border-blue-950 px-8 py-3 focus:outline-none"
                           href="{{route('customer.add')}}">
                                <span
                                    class="absolute inset-y-0 left-0 w-[0px] bg-blue-950 transition-all group-hover:w-full group-active:bg-blue-950"
                                ></span>

                            <span
                                class="relative text-sm font-medium text-black transition-colors group-hover:text-white"
                            >
                                    Tambah Pengguna
                                </span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </header>


    <div class="overflow-x-auto overflow-scroll p-5 mb-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm ">
            <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nama</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Alamat</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">No Hp</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Paket</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Durasi</th>
                <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Jatuh Tempo</th> -->
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Pembayaran</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Pengaturan</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-left">
            @foreach($customers['all'] as $customer)
            <tr>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 pt-5 pb-5">{{\Illuminate\Support\Str::limit($customer->name,15)}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{\Illuminate\Support\Str::limit($customer->address,15)}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{$customer->phone}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{$customer->billing->amount ?? "??"}} {{$customer->billing->type ?? "??"}}</td>

                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                    {{$customer->payments?->last()?->created_at->format('d-M-Y') ?? "??"}}<br>
                    {{\Illuminate\Support\Carbon::parse($customer->expired)->format('d-m-Y')}}
                </td>

                <td>
                    @switch($customer->status ?? '0' === '1')
                        @case('1')
                            <span class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-4 py-0.5 text-emerald-700">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-ms-1 me-1.5 h-4 w-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                                <p class="whitespace-nowrap text-sm">Lunas</p>
                            </span>
                            @break
                        @case('0')
                            <span class="inline-flex items-center justify-center rounded-full bg-red-100 px-4 py-0.5 text-red-700">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-ms-1 me-1.5 h-4 w-4"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                                    />
                                    </svg>

                                    <p class="whitespace-nowrap text-sm">Isolir</p>
                                </span>
                            @break
                        @default
                            <span class="inline-flex items-center justify-center rounded-full bg-yellow-100 px-4 py-0.5 text-red-700">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-ms-1 me-1.5 h-4 w-4"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                                    />
                                    </svg>

                                    <p class="whitespace-nowrap text-sm">Pending</p>
                            </span>
                            @break
                        @endswitch
                </td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                    <button>
                        <a class="group relative inline-block overflow-hidden rounded-md border border-gray-800 px-3 py-1  focus:outline-none"
                           href="{{route('payment.view',[$customer->id])}}">
                                <span
                                    class="absolute inset-y-0 left-0 w-[0px] bg-gray-800 transition-all group-hover:w-full group-active:bg-gray-800"
                                ></span>

                            <span
                                class="relative text-sm font-medium text-black transition-colors group-hover:text-white"
                            >
                                    Lihat
                                </span>
                        </a>
                    </button>
                </td>
                <td class="whitespace-nowrap px-4 py-2 flex items-center gap-2">
                        <a class="group relative inline-block overflow-hidden rounded-md border border-[#399918] px-3 py-1  focus:outline-none"
                           href="{{route("customer.edit",['id' => $customer->id]) }}">
                                <span class="absolute inset-y-0 left-0 w-[0px] bg-[#399918] transition-all group-hover:w-full group-active:bg-[#399918]"></span>
                                <span class="relative text-sm font-medium text-black transition-colors group-hover:text-white">Edit</span>
                        </a>


                    <button data-id="{{$customer->id}}" class="openModalButton group relative inline-block overflow-hidden rounded-md border border-[#F5004F] px-3 py-1  focus:outline-none">
                        <span class="absolute inset-y-0 left-0 w-[0px] bg-[#F5004F] transition-all group-hover:w-full group-active:bg-[#F5004F]"></span>
                        <span class="relative text-sm font-medium text-black transition-colors group-hover:text-white">Hapus</span>
                    </button>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

{{--    ADDONS--}}
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-sm w-full">
            <div class="px-4 py-2 bg-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Konfirmasi</h3>
                <button id="closeModalButton" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>
            <div class="p-4">
                <p>Apakah Anda yakin ingin menghapus Data ini?</p>
            </div>
            <div class="px-4 py-2 bg-gray-200 flex justify-end gap-4">
                <button id="cancelButton" class="bg-gray-500 text-white px-4 py-2 rounded-md">Kembali</button>
                <button id="deleteButton" class="bg-red-500 text-white px-4 py-2 rounded-md">Hapus</button>
            </div>
        </div>
    </div>

    @section('head')
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" rel="stylesheet">
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let itemIdToDelete = null;

        const modal = document.getElementById('modal');
        const openModalButtons = document.querySelectorAll('.openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const cancelButton = document.getElementById('cancelButton');
        const deleteButton = document.getElementById('deleteButton');

        const csrfToken = '{{csrf_token()}}'


        openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                itemIdToDelete = button.getAttribute('data-id');
                modal.classList.remove('hidden');
            });
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            itemIdToDelete = null;
        });

        cancelButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            itemIdToDelete = null;
        });

        deleteButton.addEventListener('click', () => {
            console.log({ id: itemIdToDelete })
            if (itemIdToDelete !== null) {
                fetch('api/customers/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id: itemIdToDelete })
                })

                    .then(response => response.json())
                    .then(data => {
                        modal.classList.add('hidden');
                        // Optionally remove the deleted item from the DOM
                        document.querySelector(`[data-id="${itemIdToDelete}"]`).closest('tr').remove();
                        itemIdToDelete = null;
                        Swal.fire({
                            title: 'INFO',
                            text: data.message,
                            icon: data.type,
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'ERROR!',
                            text: error.message,
                            icon: 'warning',
                            confirmButtonText: 'BACK'
                        });
                    });

            }
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
                itemIdToDelete = null;
            }
        });

    </script>
@endsection
