<!-- container form login murid -->
<div id="form-murid">
    <div
        class="md:w-md form-box mt-20 z-1 bg-white rounded-2xl border border-b-8 border-gray-500 p-8 py-12 shadow-xl w-full max-w-sm transition-all duration-500 opacity-100 scale-100 relative">

        <!-- gambar animasi form murid -->
        <div class="absolute top-[-8rem] left-[5rem] md:left-[7rem] z-10">
            <img src="{{ asset('img/icon-login-murid.gif') }}" alt="" class="w-[10rem]">
        </div>

        <!-- form login murid -->
        <h1 class="text-2xl font-bold text-center mb-6">Login Murid</h1>

        <form wire:submit.prevent="login" class="space-y-4">
            <!-- input NIPD -->
            <div>
                <label for="nipd" class="block font-medium text-gray-700">NIPD</label>
                <input wire:model.defer="nipd" type="text" id="nipd"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan NIPD/NIS" required>
            </div>

            <!-- input PASSWORD -->
            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input wire:model.defer="password" type="password" id="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan Password" required>
            </div>

            <!-- button login murid -->
            <div class="flex justify-center items-center p-5 mt-5">
                <button type="submit"
                    class="border bg-gradient-to-t from-green-600 to-green-500 border-b-8 border-green-700 p-1 rounded-xl shadow-lg text-xl text-white px-20 font-bold text-shadow-md transition-all duration-500 hover:scale-105 active:border-b-0 active:shadow-inner">
                    Login
                </button>
            </div>
        </form>

        <!-- link ke form login guru -->
        <p class="text-center text-sm mt-2">
            Apakah Anda Guru?
            <a wire:navigate href="{{ route('auth.login-guru') }}"
                class="text-blue-500 hover:underline">Login Guru</a>
        </p>
    </div>
</div>
