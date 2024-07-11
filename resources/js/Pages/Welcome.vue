<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
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
                                    class="text-center text-2xl font-semibold -tracking-tight font-sfprodisplay"
                                >
                                    Join as a client or a freelancer
                                </p>
                                <!-- register buttons -->
                                <div
                                    class="flex justify-center items-start gap-2"
                                >
                                    <Link
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="flex flex-col justify-center items-center gap-2.5 w-48 h-28 p-5 bg-olivegreen/80 rounded-xl shadow-inner"
                                    >
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
                                            <svg
                                                width="27"
                                                height="27"
                                                viewBox="0 0 27 27"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <circle
                                                    cx="13.5"
                                                    cy="13.5"
                                                    r="11.5"
                                                    stroke="#EBEBEB"
                                                    stroke-opacity="0.75"
                                                    stroke-width="3"
                                                />
                                            </svg>
                                        </div>
                                        <!-- text -->
                                        <div
                                            class="text-white/80 text-lg font-normal weight font-sfprodisplay overflow-ellipsis tracking-tight"
                                        >
                                            I'm a freelancer, looking for work
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- alisin -->
                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
</template>
