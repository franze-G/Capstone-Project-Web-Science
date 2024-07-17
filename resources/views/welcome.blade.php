<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lokalista</title>

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
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-olivegreen hover:text-emerald ">
                                    Login
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
                                        <!-- Freelancer link -->
                                        <a href="{{ route('register', ['role' => 'freelancer']) }}"
                                            class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-emerald/75 rounded-xl shadow-innershadow hover:bg-emerald">
                                            <!-- Icons and text for freelancer -->
                                            <div class="flex justify-between items-start self-stretch">
                                                <!-- Freelancer icon SVG -->
                                                <svg width="29" height="26" viewBox="0 0 29 26" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <!-- SVG Path -->
                                                </svg>
                                                <div class="flex justify-center items-center">
                                                    <div
                                                        class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80">
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="text-white/80 text-lg font-semibold font-sfprodisplay tracking-tight">
                                                I'm a freelancer, looking for work
                                            </div>
                                        </a>

                                        <!-- Client link -->
                                        <a href="{{ route('register', ['role' => 'client']) }}"
                                            class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-emerald/75 rounded-xl shadow-innershadow hover:bg-emerald">
                                            <!-- Icons and text for client -->
                                            <div class="flex justify-between items-start self-stretch">
                                                <!-- Client icon SVG -->
                                                <svg width="31" height="26" viewBox="0 0 31 26" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <!-- SVG Path -->
                                                </svg>
                                                <div class="flex justify-center items-center">
                                                    <div
                                                        class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80">
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="text-white/80 text-lg font-semibold font-sfprodisplay tracking-tight">
                                                I'm a client looking for services
                                            </div>
                                        </a>
                                    </div>

                                    <!-- text -->
                                    <div class="text-white/80 text-lg font-semibold font-sfprodisplay tracking-tight">
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
