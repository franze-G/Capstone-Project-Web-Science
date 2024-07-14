<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-olivegreen/60 selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2 text-center font-tanpearl text-6xl text-white">
                        Lokal <span class="text-olivegreen">i</span> sta
                    </div>

                    <!-- navigation -->
                    @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end text-xl font-apercu">
                        @auth
                        <p class="px-3 py-2 text-olivegreen">Welcome back</p>
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-olivegreen ring-1 ring-transparent transition">
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-olivegreen hover:text-emerald ">
                            log in
                        </a>
                        @endauth
                    </nav>
                    @endif
                </header>

                <main class="mt-6">
                    <div class="flex flex-col justify-center items-center self-stretch text-white">
                        <!-- heading text -->
                        <div class="flex flex-col justify-start items-center gap-7">
                            <div class="font-sans font-semibold text-white text-8xl tracking-[0.035rem]">
                                Hiring made&nbsp;<span class="text-olivegreen">simple</span>
                            </div>
                            <div class="text-white/80 self-stretch font-normal text-center text-2xl leading-tight">
                                Lokalista gives you a platform to display your
                                job openings and a <br />powerful dashboard to
                                manage your employee.
                            </div>
                        </div>
                        <!-- body -->
                        <div class="flex justify-center items-center gap-5">
                            <!-- image -->
                            <!-- <img src="{{ asset('img/model.svg') }}" alt="Model Image"> -->
                            <img src="{{ asset('storage/images/model.svg') }}" alt="Model Image">

                            <!-- text buttons -->
                            @if (Route::has('register'))
                            <div class="flex flex-col justify-center items-center gap-5">
                                <p class="text-center text-2xl font-semibold tracking-[0.18px] font-sans m-1">
                                    Join as a client or a freelancer
                                </p>
                                <!-- register buttons -->
                                <div class="flex justify-center items-start gap-9">
                                    <a href="{{route('register')}}"
                                        class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-emerald/75 rounded-xl shadow-innershadow hover:bg-emerald">
                                        <!-- icons -->
                                        <div class="flex justify-between items-start self-stretch">
                                            <!-- briefcase -->
                                            <svg width="29" height="26" viewBox="0 0 29 26" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 17.4643C18 17.9576 17.6084 18.3571 17.125 18.3571H11.875C11.3916 18.3571 11 17.9576 11 17.4643V14.7857H0.5V22.8214C0.5 24.25 1.725 25.5 3.125 25.5H25.875C27.275 25.5 28.5 24.25 28.5 22.8214V14.7857H18V17.4643ZM25.875 5.85714H21.5V3.17857C21.5 1.75 20.275 0.5 18.875 0.5H10.125C8.725 0.5 7.5 1.75 7.5 3.17857V5.85714H3.125C1.725 5.85714 0.5 7.10714 0.5 8.53571V13H28.5V8.53571C28.5 7.10714 27.275 5.85714 25.875 5.85714ZM18 5.85714H11V4.07143H18V5.85714Z"
                                                    fill="#EBEBEB" fill-opacity="0.75" />
                                            </svg>
                                            <!-- fill -->
                                            <div class="flex justify-center items-center">
                                                <div
                                                    class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- text -->
                                        <div
                                            class="text-white/80 text-lg font-semibold font-sfprodisplay tracking-tight">
                                            I'm a freelancer, looking for work
                                        </div>
                                    </a>

                                    <a href="{{route('register')}}"
                                        class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-emerald/75 rounded-xl shadow-innershadow hover:bg-emerald">
                                        <!-- icons -->
                                        <div class="flex justify-between items-start self-stretch">
                                            <!-- client -->
                                            <svg width="31" height="26" viewBox="0 0 31 26" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M30.5 13.3906V12.6094C30.5 12.1777 30.1644 11.8281 29.75 11.8281H16.625V9.875H20C20.8283 9.875 21.5 9.17529 21.5 8.3125V2.0625C21.5 1.19971 20.8283 0.5 20 0.5H11C10.1717 0.5 9.5 1.19971 9.5 2.0625V8.3125C9.5 9.17529 10.1717 9.875 11 9.875H14.375V11.8281H1.25C0.835625 11.8281 0.5 12.1777 0.5 12.6094V13.3906C0.5 13.8223 0.835625 14.1719 1.25 14.1719H6.125V16.125H3.5C2.67172 16.125 2 16.8247 2 17.6875V23.9375C2 24.8003 2.67172 25.5 3.5 25.5H11C11.8283 25.5 12.5 24.8003 12.5 23.9375V17.6875C12.5 16.8247 11.8283 16.125 11 16.125H8.375V14.1719H22.625V16.125H20C19.1717 16.125 18.5 16.8247 18.5 17.6875V23.9375C18.5 24.8003 19.1717 25.5 20 25.5H27.5C28.3283 25.5 29 24.8003 29 23.9375V17.6875C29 16.8247 28.3283 16.125 27.5 16.125H24.875V14.1719H29.75C30.1644 14.1719 30.5 13.8223 30.5 13.3906ZM12.5 6.75V3.625H18.5V6.75H12.5ZM9.5 22.375H5V19.25H9.5V22.375ZM26 22.375H21.5V19.25H26V22.375Z"
                                                    fill="#EBEBEB" fill-opacity="0.75" />
                                            </svg>

                                            <!-- fill -->
                                            <div class="flex justify-center items-center">
                                                <div
                                                    class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- text -->
                                        <div
                                            class="text-white/80 text-lg font-semibold font-sfprodisplay tracking-tight">
                                            I'm a client,
                                            hiring for a project
                                        </div>
                                    </a>
                                </div>
                                @else
                                @endauth
                                <div class="font-apercu">
                                    Already have an account?
                                    <a href="{{ route('login') }}"
                                        class="text-olivegreen underline underline-offset-2 hover:no-underline hover:text-emerald">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/60 font-sfprorounded">
                    Carl Andrei Del Rosario | Franzelighil Garcia
                </footer>
            </div>
        </div>
    </div>
</body>

</html>