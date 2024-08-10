<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite([
        'resources/css/app.css',
        'resources/css/output.css',
        'resources/js/app.js',
        ]))
    <title>Not Found 404</title>
</head>
<body>
<div class="grid h-screen place-content-center bg-white px-4">
    <div class="text-center">

        <div class="grid p-10 place-content-center bg-white px-4">
            <h1 class="uppercase tracking-widest text-gray-500">{{__("messages.404.message")}}</h1>
        </div>

        <a
            class="inline-block rounded border border-current border-gray-500 px-8 py-3 text-sm font-medium text-gray-500 transition hover:rotate-2 hover:scale-110 focus:outline-none focus:ring-gray-500 active:text-gray-500"
            href="/"
        >
            {{__("messages.404.back_button")}}
        </a>
    </div>
</div>
</body>
</html>
