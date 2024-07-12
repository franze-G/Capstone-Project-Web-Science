<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    clientRegister: {
        type: Boolean,
    },
    imageUrl: {
        type: String,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Lokalista" />
    <div class="bg-[#151515] text-gray-50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-start selection:bg-olivegreen selection:text-white px-2 py-1 gap-4"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3 text-center"
                >
                    <div
                        class="flex lg:justify-center text-center lg:col-start-2 font-pearl text-7xl"
                    >
                        Lokal
                        <span class="text-olivegreen">i</span>
                        sta
                    </div>

                    <!-- nav buttons -->
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-center rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div
                        class="flex flex-col justify-center items-center self-stretch"
                    >
                        <!-- heading text -->
                        <div
                            class="flex flex-col justify-start items-center font-sfprodisplay gap-7"
                        >
                            <div class="font-medium text-7xl">
                                Hiring made&nbsp;<span class="text-olivegreen"
                                    >simple</span
                                >
                            </div>
                            <div
                                class="self-stretch text-center font-light text-lg"
                            >
                                Lokalista gives you a platform to display your
                                job openings and a <br />powerful dashboard to
                                manage your employee.
                            </div>
                        </div>
                        <!-- body -->
                        <div class="flex justify-center items-center gap-5">
                            <!-- image -->
                            <img :src="imageUrl" alt="Model Image" />
                            <!-- text buttons -->
                            <div
                                class="flex flex-col justify-center items-center gap-5"
                            >
                                <p
                                    class="text-center text-2xl font-semibold -tracking-tight font-sfprodisplay m-1"
                                >
                                    Join as a client or a freelancer
                                </p>
                                <!-- register buttons -->
                                <div
                                    class="flex justify-center items-start gap-9"
                                >
                                    <Link
                                        v-if="client.client.register"
                                        :href="route('register')"
                                        class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-[#87986A]/80 rounded-xl shadow-[inset_5px_5px_20px_2px_rgba(207, 225, 185, 0.30)] hover:bg-[#87986A]"
                                    >
                                        <div
                                            class="w-[157px] h-[157px] bg-olivegreen/80 rounded-full blur-[60px]"
                                        ></div>
                                        <!-- icons -->
                                        <div
                                            class="flex justify-between items-start self-stretch"
                                        >
                                            <!-- briefcase -->
                                            <svg
                                                width="29"
                                                height="26"
                                                viewBox="0 0 29 26"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M18 17.4643C18 17.9576 17.6084 18.3571 17.125 18.3571H11.875C11.3916 18.3571 11 17.9576 11 17.4643V14.7857H0.5V22.8214C0.5 24.25 1.725 25.5 3.125 25.5H25.875C27.275 25.5 28.5 24.25 28.5 22.8214V14.7857H18V17.4643ZM25.875 5.85714H21.5V3.17857C21.5 1.75 20.275 0.5 18.875 0.5H10.125C8.725 0.5 7.5 1.75 7.5 3.17857V5.85714H3.125C1.725 5.85714 0.5 7.10714 0.5 8.53571V13H28.5V8.53571C28.5 7.10714 27.275 5.85714 25.875 5.85714ZM18 5.85714H11V4.07143H18V5.85714Z"
                                                    fill="#EBEBEB"
                                                    fill-opacity="0.75"
                                                />
                                            </svg>
                                            <!-- fill -->
                                            <div
                                                class="flex justify-center items-center"
                                            >
                                                <div
                                                    class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80"
                                                ></div>
                                            </div>
                                        </div>
                                        <!-- text -->
                                        <div
                                            class="text-white/80 text-lg font-normal font-semibold font-sfprodisplay tracking-tight"
                                        >
                                            I'm a freelancer, looking for work
                                        </div>
                                    </Link>
                                    <Link
                                        v-if="clientRegister"
                                        :href="route('client.client.register')"
                                        class="group flex flex-col justify-center items-center gap-2.5 w-56 h-32 p-6 bg-[#87986A]/80 rounded-xl shadow-[inset_5px_5px_20px_2px_rgba(207, 225, 185, 0.30)] hover:bg-[#87986A]"
                                    >
                                        <div
                                            class="w-[157px] h-[157px] bg-olivegreen/80 rounded-full blur-[60px]"
                                        ></div>
                                        <!-- icons -->
                                        <div
                                            class="flex justify-between items-start self-stretch"
                                        >
                                            <!-- client -->
                                            <svg
                                                width="31"
                                                height="26"
                                                viewBox="0 0 31 26"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M30.5 13.3906V12.6094C30.5 12.1777 30.1644 11.8281 29.75 11.8281H16.625V9.875H20C20.8283 9.875 21.5 9.17529 21.5 8.3125V2.0625C21.5 1.19971 20.8283 0.5 20 0.5H11C10.1717 0.5 9.5 1.19971 9.5 2.0625V8.3125C9.5 9.17529 10.1717 9.875 11 9.875H14.375V11.8281H1.25C0.835625 11.8281 0.5 12.1777 0.5 12.6094V13.3906C0.5 13.8223 0.835625 14.1719 1.25 14.1719H6.125V16.125H3.5C2.67172 16.125 2 16.8247 2 17.6875V23.9375C2 24.8003 2.67172 25.5 3.5 25.5H11C11.8283 25.5 12.5 24.8003 12.5 23.9375V17.6875C12.5 16.8247 11.8283 16.125 11 16.125H8.375V14.1719H22.625V16.125H20C19.1717 16.125 18.5 16.8247 18.5 17.6875V23.9375C18.5 24.8003 19.1717 25.5 20 25.5H27.5C28.3283 25.5 29 24.8003 29 23.9375V17.6875C29 16.8247 28.3283 16.125 27.5 16.125H24.875V14.1719H29.75C30.1644 14.1719 30.5 13.8223 30.5 13.3906ZM12.5 6.75V3.625H18.5V6.75H12.5ZM9.5 22.375H5V19.25H9.5V22.375ZM26 22.375H21.5V19.25H26V22.375Z"
                                                    fill="#EBEBEB"
                                                    fill-opacity="0.75"
                                                />
                                            </svg>

                                            <!-- fill -->
                                            <div
                                                class="flex justify-center items-center"
                                            >
                                                <div
                                                    class="w-7 h-7 rounded-full border-4 border-gray-200/75 group-hover:bg-gray-200/80"
                                                ></div>
                                            </div>
                                        </div>
                                        <!-- text -->
                                        <div
                                            class="text-white/80 text-left text-lg font-semibold font-sfprodisplay overflow-ellipsis tracking-tight"
                                        >
                                            I'm a client, <br />
                                            hiring for a project
                                        </div>
                                    </Link>
                                </div>
                                <div class="">
                                    Already have an account?
                                    <a href="/" class="">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- alisin -->
                <footer
                    class="py-16 text-center text-xs text-black dark:text-white/60"
                >
                    Carl Andrei Del Rosario | Franzelighil Garcia
                </footer>
            </div>
        </div>
    </div>
</template>
