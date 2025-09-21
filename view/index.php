<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // biar tidak muncul terus
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include("../shared/link.php"); ?>
</head>

<body class="bg-gray-200">
    <main class="min-h-screen flex justify-center items-center p-4">
        <!-- container form login murid -->
        <div id="form-murid">
            <div class="md:w-md form-box mt-20 z-1 bg-white rounded-2xl border border-b-8 border-gray-500 p-8 py-12 shadow-xl w-full max-w-sm transition-all duration-500  opacity-100 scale-100">
                <!-- gambar animasi form murid-->
                <div class="  left-[5rem]  absolute top-[-8rem] z-10 md:left-[7rem]">
                    <img src="../img/icon-login-murid.gif" alt="" class="w-[10rem]">
                </div>
                <!-- form login murid -->
                <h1 class="text-2xl font-bold text-center mb-6">Login Murid</h1>
                <form action="../php/proses_murid.php" method="POST" class="space-y-4">
                    <!-- input NIPD-->
                    <div>
                        <label for="nipd" class="block font-medium text-gray-700">NIPD</label>
                        <input type="text" id="nipd" name="nipd" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan NIPD/NIS" required>
                    </div>
                    <!-- input PASSWORD -->
                    <div>
                        <label for="password" class="block font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Password" required>
                    </div>
                    <!--  button login murid -->
                    <div class="flex justify-center items-center p-5 mt-5">
                        <button class="border bg-gradient-to-t from-green-600 to-green-500 border-b-8 border-green-700 p-1 rounded-xl shadow-lg text-xl text-white px-20 font-bold text-shadow-md transition-all  duration-500 hover:scale-105 active:border-b-0 active:shadow-inner">
                            Login
                        </button>
                    </div>
                </form>
                <!-- link ke form login guru -->
                <p class="text-center text-sm mt-2">
                    Apakah Anda Guru?
                    <a href="#" onclick="showForm('guru')" class="text-blue-500 hover:underline">Login Guru</a>
                </p>
            </div>
        </div>

        <!-- container form login guru -->
        <div id="form-guru" class="hidden opacity-0 scale-90">
            <div class="md:w-md relative form-box mt-20 z-1 bg-white rounded-2xl border border-b-8 border-gray-500 p-8 py-12 shadow-xl w-full max-w-sm transition-all duration-500 ease-in-out ">
                <!-- gambar animasi login murid -->
                <div class="absolute top-[-8rem] left-[5rem] md:left-[7rem] z-10">
                    <img src="../img/icon-login-guru.gif" class="w-[10rem]" alt="">
                </div>
                <!-- form login guru -->
                <h1 class="text-2xl font-bold text-center mb-6">Login Guru</h1>
                <form action="../panelGuru" method="POST" class="space-y-4">
                    <!-- input NIP -->
                    <div>
                        <label for="username" class="block font-medium text-gray-700">NIP</label>
                        <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Username" required>
                    </div>
                    <!-- input password -->
                    <div>
                        <label for="password-guru" class="block font-medium text-gray-700">Password</label>
                        <input type="password" id="password-guru" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Password" required>
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
                    <a href="#" onclick="showForm('murid')" class="text-blue-500 hover:underline">Login Murid</a>
                </p>
            </div>
        </div>

    </main>

    <script>
        function showForm(type) {
            const murid = document.getElementById("form-murid");
            const guru = document.getElementById("form-guru");

            if (type === "guru") {
                murid.classList.add("opacity-0", "scale-90");
                setTimeout(() => {
                    murid.classList.add("hidden");
                    guru.classList.remove("hidden");
                    setTimeout(() => guru.classList.remove("opacity-0", "scale-90"), 10);
                }, 300);
            } else {
                guru.classList.add("opacity-0", "scale-90");
                setTimeout(() => {
                    guru.classList.add("hidden");
                    murid.classList.remove("hidden");
                    setTimeout(() => murid.classList.remove("opacity-0", "scale-90"), 10);
                }, 300);
            }
        }
    </script>
</body>

</html>