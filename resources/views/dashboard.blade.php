@extends('main')
@section('main-container')
    <div class="flex-1 p-6">
        <!-- Card -->
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8 pb-10">
            <div class="h-32 rounded-lg bg-gray-200 lg:col-span-2">
                <article class="hover:animate-background rounded-xl bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 p-0.5 shadow-xl transition hover:bg-[length:400%_400%] hover:shadow-sm hover:[animation-duration:_4s]"
                >
                    <div class="rounded-[10px] bg-white p-4 !pt-20 sm:p-6">

                        <a href="#">
                            <h3 class="mt-0.5 text-lg font-medium text-gray-900">
                                {{__("messages.dashboard.welcome_message")}}
                            </h3>
                        </a>

                        <div class="mt-4 flex flex-wrap gap-1">
                        <span
                            class="whitespace-nowrap rounded-full bg-purple-100 px-2.5 py-0.5 text-xs text-purple-600">
                            Admin
                        </span>

                            <span
                                class="whitespace-nowrap rounded-full bg-purple-100 px-2.5 py-0.5 text-xs text-purple-600"
                            >
                            Sukamurni
                        </span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="h-auto bg-white hover:animate-background rounded-xl bg-gradient-to-r from-pink-300 via-purple-300 to-indigo-400
                p-0.5 shadow-xl transition hover:bg-[length:400%_400%] hover:shadow-sm hover:[animation-duration:_4s]">
                <div class="flex flex-col rounded-lg bg-white px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Jumlah Pengguna Aktif</dt>
                    <dd class="text-4xl font-extrabold text-slate-800 md:text-5xl">{{count($active_members)}}</dd>
                </div>
            </div>

            <div class="h-auto bg-white hover:animate-background rounded-xl bg-gradient-to-r from-pink-300 via-purple-300 to-indigo-400
                p-0.5 shadow-xl transition hover:bg-[length:400%_400%] hover:shadow-sm hover:[animation-duration:_4s]">
                <div class="flex flex-col rounded-lg bg-white px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Jumlah Pengguna Isolir</dt>
                    <dd class="text-4xl font-extrabold text-slate-800 md:text-5xl">{{count($isolation_members)}}</dd>
                </div>
            </div>
        </div>
    </div>
@endsection
