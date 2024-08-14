<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    <title>Tambah Customer</title>
</head>
<body>

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Warning!</strong>
                <span class="block sm:inline">{{$error}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
        </div>
    @endforeach
@endif
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
        <h1 class="text-center text-2xl font-bold text-black sm:text-3xl">Tambah Data Pengguna</h1>

        <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
            Form Untuk Menambah Data Pengguna
        </p>

        <form method="post" action="{{route('api.customer.add')}}" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-xl sm:p-6 lg:p-8 shadow-slate-400">
            @csrf
            <p class="text-center text-lg font-medium">Data Pengguna</p>

            <div>
                <label
                    for="Nama"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="text"
                        id="Nama"
                        name="name"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Nama"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            Nama
                        </span>
                </label>
            </div>
            <div>
                <label
                    for="Email"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="example@gmail.com"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            Email
                        </span>
                </label>
            </div>
            <div>
                <label
                    for="phone"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="+62"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            No Handphone
                        </span>
                </label>
            </div>

            <div>
                <label
                    for="Alamat"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="text"
                        id="Alamat"
                        name="address"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Alamat"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            Alamat
                        </span>
                </label>
            </div>

            <span class="relative flex justify-center">
                    <div class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-transparent bg-gradient-to-r from-transparent via-gray-500 to-transparent opacity-75">
                    </div>
                    <span class="relative z-10 bg-white px-6">Paket</span>
                </span>
            <div class="flex space-x-4">
                <div class="flex-1 mr-1">
                    <label
                        for="PaketLeft"
                        class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                    >
                        <input
                            type="number"
                            id="PaketLeft"
                            name="amount"
                            min="0"
                            class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                            placeholder="Paket"
                        />
                        <span
                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                        >
                                Jumlah
                            </span>
                    </label>
                </div>
                <div class="flex-1 ml-1">
                    <label
                        for="PaketRight"
                        class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                    >
                        <select
                            id="PaketRight"
                            name="type"
                            class="peer border-none bg-transparent focus:border-transparent focus:outline-none focus:ring-0 w-full"
                        >
                            <option value="mbps">Mbps</option>
                            <option value="device">Device</option>
                        </select>
                        <span
                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                        >
                                Satuan
                            </span>
                    </label>
                </div>
            </div>

            <div>
                <label
                    for="Jatuh Tempo"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <input
                        type="date"
                        id="Jatuh Tempo"
                        name= "expired"
                        class="peer border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Jatuh Tempo"
                    />
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            Jatuh Tempo
                        </span>
                </label>
            </div>

            <div>
                <label
                    for="PaketRight"
                    class="p-3 relative block rounded-md border border-gray-200 shadow-sm focus-within:border-slate-700 focus-within:ring-1 focus-within:ring-slate-300"
                >
                    <select
                        id="PaketRight"
                        name="status"
                        class="peer border-none bg-transparent focus:border-transparent focus:outline-none focus:ring-0 w-full"
                    >
                        <option value="1">Aktif</option>
                        <option value="2">Pending</option>
                        <option value="0">Isolir</option>
                    </select>
                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
                    >
                            Status
                        </span>
                </label>
            </div>

            <div class="flex space-x-4">
                <a href="{{route('default')}}"
                   class="inline-block rounded border border-[#F5004F] bg-[#F5004F] px-12 py-3 text-sm font-medium text-white text hover:bg-transparent hover:text-[#F5004F] focus:outline-none shadow-sm shadow-slate-400"
                >
                    Kembali
                </a>

                <button
                    type="submit"
                    class="block w-full rounded border border-[#399918] bg-[#399918] px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-[#399918] focus:outline-none shadow-sm  shadow-slate-400"
                >
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
