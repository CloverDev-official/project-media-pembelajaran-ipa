<!-- container form login guru -->
<div id="form-guru">
    <div
        class="md:w-md relative form-box mt-20 z-1 bg-white rounded-2xl border border-b-8 border-gray-500 p-8 py-12 shadow-xl w-full max-w-sm transition-all duration-500 ease-in-out ">
        <!-- gambar animasi login murid -->
        <div class="absolute top-[-8rem] left-[5rem] md:left-[7rem] z-10">
            <img src="../img/icon-login-guru.gif" class="w-[10rem]" alt="">
        </div>
        <!-- form login guru -->
        <h1 class="text-2xl font-bold text-center mb-6">Login Guru</h1>
        <form wire:submit.prevent="login" class="space-y-4">
            <!-- input NIP -->
            <div>
                <label for="username" class="block font-medium text-gray-700">NIP</label>
                <input type="text" id="username" name="username" wire:model.defer="username"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan Username" required>
            </div>
            <!-- input password -->
            <div>
                <label for="password-guru" class="block font-medium text-gray-700">Password</label>
                <input type="password" id="password-guru" name="password"
                    wire:model.defer="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan Password" required>
            </div>

            <!-- button login guru -->
            <div class="flex justify-center items-center p-5 mt-5">
                <button
                    class="border bg-gradient-to-t from-green-600 to-green-500 border-b-8 border-green-700 p-1 rounded-xl shadow-lg text-xl text-white px-20 font-bold text-shadow-md transition-all duration-150 hover:scale-105 active:border-b-0 active:shadow-inner">
                    Login
                </button>
            </div>
        </form>

        <!-- link ke form login murid -->
        <p class="text-center text-sm mt-2">
            Apakah Anda Murid?
            <a wire:navigate href="login-murid" class="text-blue-500 hover:underline">Login
                Murid</a>
        </p>
    </div>
</div>
