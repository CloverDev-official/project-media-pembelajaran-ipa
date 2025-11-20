<main class="min-h-screen bg-subtle">
    <!-- judul -->
    <div class="pt-10 text-center">
        <h1 class="font-bold text-5xl text-shadow-2xs text-shadow-gray-200 text-main capitalize">
            ulangan</h1>
        <p class="mt-1 font-normal text-gray-500 capitalize">pilih gim yang ingin kamu mainkan disini
        </p>
    </div>
    <div class="mt-10 mx-6 lg:m-10 lg:mx-20 flex justify-center">

        <div
            class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center mb-20">
            <!-- ulangan card 1 -->
            <div class="flex justify-center items-center">
                @foreach ($daftarUlangan as $ulangan)
                    <div
                        class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                        <!-- container gambar ulangan` -->
                        <div class="flex justify-center">
                            <!-- gambar ulangan -->
                            <img src="{{ $ulangan->gambar ? asset('storage/' . $ulangan->gambar) : '' }}"
                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                        </div>
                        <!-- judul dan deskripsi ulangan -->
                        <div class="mb-3 py-2">
                            <h2 class="font-bold text-main text-lg capitalize">{{ $ulangan->judul }}
                            </h2>
                            <p class="font-normal text-xs capitalize">{{ $ulangan->deskripsi }}</p>
                        </div>
                        <!-- btn baca -->
                        <a wire:navigate href="{{ route('ulangan', $ulangan->id) }}"
                            class="flex flex-col items-center">
                            <button
                                class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-main bg-hover-dark active:scale-95 text-white capitalize">
                                mainkan
                            </button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
