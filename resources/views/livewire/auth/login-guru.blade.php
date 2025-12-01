<div class="flex  justify-center w-[45rem]">
    <!-- container form login guru -->
    <div id="form-guru"
        class="rounded-lg bg-[url(../img/bg-login-mobile.png)] md:bg-[url(../img/bg-login.png)] bg-contain bg-no-repeat md:w-[30rem] drop-shadow-lg">
        <div class="md:px-5 form-box mt-10 md:mt-20 z-1  w-full md:h-[34rem] relative">

            <!-- logo -->
            <div class="flex justify-center items-center">
                <img src="../img/paw-paw.png" class="w-16 h-16 md:w-28 md:h-28" alt="">
            </div>

            <!-- teks selamat datang -->
            <h1 class="text-2xl md:text-4xl font-bold text-center my-5 capitalize">selamat datang!
            </h1>

            <!-- switch form login -->
            <div class="flex justify-center items-center mb-8">
                <div class="bg-blue-500 rounded-lg p-2 w-[15rem]">
                    <div class="flex justify-center gap-4">
                        <a wire:navigate href="login-murid">
                            <div
                                class="bg-blue-500 rounded-lg p-1 md:p-2 w-[6rem] transition-all duration-100 hover:bg-blue-700 hover:text-white active:scale-95">
                                <p class=" text-center capitalize  font-semibold">
                                    murid
                                </p>
                            </div>
                        </a>
                        <div class="bg-yellow-300 p-1 md:p-2 rounded-lg w-[6rem] ">
                            <p class=" text-center capitalize text-black font-semibold">
                                guru
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="login" class="space-y-4 px-10">
                <!-- input NIP -->
                <div>
                    <label for="username"
                        class="block text-sm md:text-lg font-medium text-gray-700">Email</label>
                    <input type="text" id="username" name="username" wire:model.defer="username"
                        class="w-full px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Email" required>
                </div>
                <!-- input password -->
                <div>
                    <label for="password-guru"
                        class="block text-sm md:text-lg font-medium text-gray-700">Password</label>
                    <input type="password" id="password-guru" name="password"
                        wire:model.defer="password"
                        class="w-full px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Password" required>
                </div>

                <!-- button login guru -->
                <div class="flex justify-center items-center p-5">
                    <button
                        class="capitalize bg-yellow-300 w-full p-2 py-2 rounded-full shadow-sm text-lg text-black px-6 md:px-10  transition-all duration-150 hover:scale-[1.05] active:scale-95 active:shadow-inner">
                        masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
