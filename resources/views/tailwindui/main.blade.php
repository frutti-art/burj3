<!doctype html>
<html style="display: none;">
{{--<html data-theme="dracula">--}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Project</title>

    <!-- Stylesheet -->
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

            const currentTheme = localStorage.theme || 'light';
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
    class="container mx-auto max-w-3xl p-2 md:px-24 pb-24 absolute inset-0 h-full w-full bg-slate-50 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] dark:bg-[#181818] dark:bg-none">
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

    if (session_error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: session_error,
            confirmButtonColor: "#3949AB",
        });
    }

    if (session_success) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: session_success,
        });
    }

    const themeToggle = document.getElementById('theme-toggle');

    themeToggle.addEventListener('click', () => {
        const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
        applyTheme(newTheme);
    });
    // });

</script>
</body>
</html>
