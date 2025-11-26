<div class="flex justify-center w-[45rem]">
    <!-- container form login murid -->
    <div id="form-murid" class="rounded-lg bg-[url(../img/bg-login-mobile.png)] md:bg-[url(../img/bg-login.png)] bg-contain  bg-no-repeat md:w-[30rem] drop-shadow-lg">
        <div
            class="md:px-5 form-box mt-10 md:mt-20 z-1  w-full md:h-[34rem] relative">

            <!-- logo -->
            <div class="flex justify-center items-center">
                <img src="../img/paw-paw.png" class="w-16 h-16 md:w-28 md:h-28" alt="">
            </div>

            <!-- form login murid -->
            <h1 class="text-2xl md:text-4xl font-bold text-center my-5 capitalize">selamat datang!</h1>
            
            <!-- switch form login -->
            <div class="flex justify-center items-center mb-8">
                <div class="bg-blue-500 rounded-lg p-2 w-[15rem]">
                    <div class="flex justify-center gap-4">
                        <div class="bg-yellow-300 rounded-lg p-1 md:p-2 w-[6rem]">
                            <p class=" text-center capitalize text-black font-semibold">
                                murid
                            </p>
                        </div>
                        <a wire:navigate href="{{ route('auth.login-guru') }}">
                            <div class="bg-blue-500 p-1 md:p-2 rounded-lg w-[6rem] transition-all duration-100 hover:bg-blue-700 active:scale-95">
                                <p class=" text-center capitalize text-white font-semibold">
                                    guru
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
    
            <form wire:submit.prevent="login" class="space-y-4 px-10">
                <!-- input NIPD -->
                <div>
                    <label for="nipd" class="block text-sm md:text-lg font-medium text-gray-700">NIPD</label>
                    <input wire:model.defer="nipd" type="text" id="nipd"
                        class="w-full px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan NIPD/NIS" required>
                </div>
    
                <!-- input PASSWORD -->
                <div>
                    <label for="password" class="block text-sm md:text-lg font-medium text-gray-700">Password</label>
                    <input wire:model.defer="password" type="password" id="password"
                        class="w-full px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Password" required>
                </div>
    
                <!-- button login murid -->
                <div class="flex justify-center items-center p-5">
                    <button type="submit"
                        class="capitalize bg-yellow-300 w-full p-2 py-2 rounded-full shadow-sm text-lg text-black px-6 md:px-10  transition-all duration-150 hover:scale-[1.05] active:scale-95 active:shadow-inner ">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
