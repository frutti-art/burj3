<!doctype html>
<html style="display: none;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Onyx</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @stack('css')

    <script>
        (function() {
            const applyTheme = (theme) => {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                }
            };

            const currentTheme = localStorage.theme || 'dark';
            applyTheme(currentTheme);

            document.documentElement.style.display = 'block';

            document.addEventListener('DOMContentLoaded', function() {
                const theme = localStorage.theme || 'light';
                if (theme === 'dark') {
                    document.getElementById('icon-sun').classList.add('hidden');
                    document.getElementById('icon-sun').classList.remove('block');
                    document.getElementById('icon-moon').classList.add('block');
                    document.getElementById('icon-moon').classList.remove('hidden');
                } else {
                    document.getElementById('icon-sun').classList.add('block');
                    document.getElementById('icon-sun').classList.remove('hidden');
                    document.getElementById('icon-moon').classList.add('hidden');
                    document.getElementById('icon-moon').classList.remove('block');
                }
            });

            window.applyTheme = applyTheme; // Make applyTheme globally accessible
        })();
    </script>
</head>

{{--#15202B--}}
{{--#192734--}}
{{--#FFFFFF--}}
{{--#8899A6--}}
{{--#1EA1F2 buttons --}}
{{--#83cbf7 disabled buttons --}}
<body
    class="container mx-auto max-w-full p-2 sm:p-0 pb-24 absolute inset-0 h-full w-full bg-slate-50 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] dark:bg-[#21303F] dark:bg-none">
@include('tailwindui.header')

<div class="pb-24">
    @yield('content')
</div>

@include('tailwindui.footer')

@stack('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // document.addEventListener('DOMContentLoaded', () => {
    const session_error = '{{ session('error') }}';
    const session_success = '{{ session('success') }}';
    const currentTheme = localStorage.theme || 'dark';

    if (session_error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: session_error,
            confirmButtonColor: (currentTheme === 'light') ? "#3949AB" : "#20B9A6",
        });
    }

    if (session_success) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: session_success,
            confirmButtonColor: (currentTheme === 'light') ? "#3949AB" : "#20B9A6",
        });
    }

    const themeToggle = document.getElementsByClassName('theme-toggle');

    for (let i = 0; i < themeToggle.length; i++) {
        themeToggle[i].addEventListener('click', () => {
            const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
            applyTheme(newTheme);
        });
    }

</script>
</body>
</html>
