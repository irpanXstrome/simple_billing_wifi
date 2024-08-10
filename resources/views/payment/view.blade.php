<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
        'resources/css/app.css',
        'resources/css/output.css',
        'resources/js/app.js',
    ])
    <title>Edit Data</title>
</head>
<body>
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto">
        <h1 class="text-center text-2xl font-bold text-black sm:text-3xl">Rincian Pembayaran Pengguna</h1>

        <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
            Tabel rincian Pembayaran pengguna <br> Admin dapat menambah, melihat, menghapus bukti pembayaran disini
        </p>

        <div class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-xl sm:p-6 lg:p-8 shadow-slate-400">
            <p class="text-center text-lg font-medium">Data Pembayaran <b>{{$customer->name}}</b></p>

            <div class="flex space-x-4">
                <a href="{{route('customer.list')}}"
                   class="inline-block rounded border border-slate-900 bg-slate-900 px-12 py-3 text-sm font-medium text-white text hover:bg-transparent hover:text-slate-900 focus:outline-none shadow-sm shadow-slate-400"
                >
                    Kembali
                </a>

                <button class="openModalButton inline-block rounded border border-cyan-500 bg-cyan-500 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:bg-white hover:text-cyan-500 focus:outline-none shadow-sm  shadow-slate-400">
                    Tambah
                </button>

                <button
                    type="submit"
                    class="inline-block rounded border border-[#399918] bg-[#399918] px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-[#399918] focus:outline-none shadow-sm  shadow-slate-400"
                >
                    Convert To Excel
                </button>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Tanggal</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Jumlah</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Bukti Pembayaran</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Pengaturan</th>
                        <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Salary</th> -->
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                    @foreach($customer->payments ?? [] as $index => $payment)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{\Illuminate\Support\Carbon::parse($payment->paid_at)->format("d M Y")}}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">RP {{ number_format($payment->amount, 0, ',', '.')}}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <button data-id="{{$payment->id}}" data-path="{{route('payment.view.image',['customer' => $customer->id,'index' => $index])}}" class="viewImage group relative inline-block overflow-hidden rounded-md border border-[#F5004F]] px-3 py-1  focus:outline-none">
                                    <span class="absolute inset-y-0 left-0 w-[0px] bg-[#F5004F] transition-all group-hover:w-full group-active:bg-[#F5004F]"></span>
                                    <span class="relative text-sm font-medium text-black transition-colors group-hover:text-white">Lihat</span>
                                </button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 flex items-center gap-2">
                                <button>
                                    <a class="group relative inline-block overflow-hidden rounded-md border border-[#399918] px-3 py-1  focus:outline-none"
                                       href="RincianEdit.html">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[0px] bg-[#399918] transition-all group-hover:w-full group-active:bg-[#399918]"
                                    ></span>

                                        <span
                                            class="relative text-sm font-medium text-black transition-colors group-hover:text-white"
                                        >
                                        Edit
                                    </span>
                                    </a>
                                </button>

                                <button data-id="{{$payment->id}}" class="paymentDeleteButton group relative inline-block overflow-hidden rounded-md border border-[#F5004F] px-3 py-1  focus:outline-none">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[0px] bg-[#F5004F] transition-all group-hover:w-full group-active:bg-[#F5004F]"
                                    ></span>
                                        <span
                                            class="relative text-sm font-medium text-black transition-colors group-hover:text-white"
                                        >
                                        Delete
                                    </span>
                                    </a>
                                </button>
                            </td>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" rel="stylesheet">
@endsection


<!-- Modal structure -->
<div id="formModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 shadow-xl w-full max-w-lg">
        <!-- Close button -->
        <button class="closeModalButton text-gray-500 hover:text-gray-700 float-right">
            &times;
        </button>

        <!-- Modal content -->
        <form id="addUserForm" class="space-y-4" method="POST">
            <p class="text-center text-lg font-medium">Data Pengguna</p>

            <div>
                <label
                    for="Tanggal"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="date"
                        id="Tanggal"
                        name="paid_at"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Tanggal"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
            Tanggal
        </span>
                </label>
            </div>

            <div>
                <label
                    for="TotalHarga"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="number"
                        id="TotalHarga"
                        name="amount"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Total Harga"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
            Total Harga
        </span>
                </label>
            </div>

            <div class="flex items-center justify-center w-full">
                <label
                    for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-100 bg-white"
                >
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg
                            class="w-8 h-8 mb-4 text-gray-500"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 16"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                            />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>

                        <p id="file-name" class="text-sm text-gray-500 mt-2"></p>
                    </div>
                    <input id="dropzone-file" name="proof_image" type="file" class="hidden" />
                </label>
            </div>


            <div class="flex space-x-4">
                <button type="button" class="closeModalButton inline-block rounded border border-[#F5004F] bg-[#F5004F] px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-[#F5004F] focus:outline-none shadow-sm shadow-slate-400">
                    Kembali
                </button>

                <button
                    type="submit"
                    class="block w-full rounded border border-[#399918] bg-[#399918] px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-[#399918] focus:outline-none shadow-sm shadow-slate-400"
                >
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const openModalButtons = document.querySelectorAll('.viewImage');
    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            imagePath = button.getAttribute('data-path');
            Swal.fire({
                imageUrl: imagePath,
                imageHeight: 360,
                imageWidth: 360,
                imageAlt: "Bukti"
            });
        });
    });

    const paymentDeleteButtons = document.querySelectorAll('.paymentDeleteButton');
    paymentDeleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we process your request',
                        icon: 'info',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading(); // Show loading spinner
                        }
                    });
                    itemIdToDelete = button.getAttribute('data-id');
                    const csrfToken = "{{csrf_token()}}";

                    axios.post('/api/payment/delete', {
                        id: itemIdToDelete
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            console.log(data);
                            console.log(response);
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
                                text: error.response ? error.response.data.message : error.message,
                                icon: 'warning',
                                confirmButtonText: 'BACK'
                            });
                        });
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.querySelector('.openModalButton');
        const closeModalButtons = document.querySelectorAll('.closeModalButton');
        const modal = document.getElementById('formModal');

        openModalButton.addEventListener('click', function () {
            modal.classList.remove('hidden');
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        });
    });

    // JavaScript untuk menampilkan nama file yang dipilih
    const inputFile = document.getElementById('dropzone-file');
    const fileNameDisplay = document.getElementById('file-name');

    inputFile.addEventListener('change', function() {
        if (inputFile.files.length > 0) {
            fileNameDisplay.textContent = 'File Di Pilih: '+inputFile.files[0].name;
        } else {
            fileNameDisplay.textContent = ''; // Kosongkan jika tidak ada file
        }
    });

    document.getElementById('addUserForm').addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        formData.append('id', {{$customer->id}});
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we process your request',
            icon: 'info',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading(); // Show loading spinner
            }
        });
        try {
            const response = await fetch('/api/payment/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();

            console.log(result);
            // Handle success, e.g., close modal and show a success message
            document.getElementById('formModal').classList.add('hidden');
            if(result.type != 'error'){
                setTimeout(function(){
                    location.reload();
                    Swal.fire({
                        title: 'INFO',
                        text: result.message,
                        icon: result.type,
                        confirmButtonText: 'OK'
                    });
                }, 2000);
            }else {
                Swal.fire({
                    title: 'INFO',
                    text: result.message,
                    icon: result.type,
                    confirmButtonText: 'OK'
                });
            }

        } catch (error) {
            const result = {
                message: "ERROR",
                type: "error"
            }
            document.getElementById('formModal').classList.add('hidden');
        }
    });


</script>
</body>
</html>
