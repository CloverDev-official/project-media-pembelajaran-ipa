<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <?php include("../shared/link.php"); ?>
</head>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>

<body class="bg-gray-50 text-gray-800">
    <?php include("../shared/header.php"); ?>

    <main class="min-h-screen">
        <div class="p-6 md:p-10">
            <div class="flex flex-col lg:flex-row gap-10 mt-10">

                <!-- Kartu Mata Pelajaran -->
                <div class="flex justify-center">
                    <div class=" border-gray-300 shadow-sm rounded-2xl bg-white p-4 w-72 h-auto ">
                        <div class="text-center">
                            <div class="bg-gray-100 p-3 w-full h-52 rounded-lg flex justify-center items-center">
                                <img src="" alt="Cover" class="object-contain h-full">
                            </div>
                            <div class="mt-4">
                                <h1 class="font-bold text-2xl text-green-700">IPA Kelas 9</h1>
                                <p class="text-sm text-gray-600 mt-1">Pelajari konsep dasar fisika dengan materi
                                    interaktif.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Bab -->
                <div class="flex flex-col gap-5 w-full">
                    <h1
                        class="font-bold text-xl mb-2 text-white text-shadow-xs  bg-green-400 p-2 pl-5 border-b-2 border-l-2 border-green-600 rounded-full w-[10rem]">
                        <i class="fa fa-book  "></i> Pilih Bab</h1>

                    <!-- Template bab -->
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        
                        <div class="bg-[#EAFFEB] border-1  border-green-600 shadow-md p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-5 transition-all duration-300 hover:shadow-lg hover:scale-[1.01] md:w-full">
                            <a href="bab<?= $i ?>.php">

                            <div class="flex items-center gap-5 w-full md:w-auto">
                                <div class="bg-green-400 rounded-lg w-14 h-14 flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl text-shadow-lg"><i
                                            class="fa fa-book"></i></span>
                                </div>
                                <h1 class="font-semibold text-lg">Bab <?= $i ?>: Pertumbuhan dan Perkembangan</h1>
                            </div>

                            <div class="flex items-center gap-8 mt-3 md:mt-0">
                                <div class="text-center">
                                    <h1 class="text-sm text-gray-600">Latihan</h1>
                                    <p class="text-green-600 font-bold">100%</p>
                                </div>
                                <a href="bab<?= $i ?>.php">
                                    <button
                                        class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:border-0  px-4 py-2 bg-green-400 hover:bg-green-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md">
                                        Mulai
                                    </button>
                                </a>
                            </div>
                            </a>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>
        </div>
    </main>

    <?php include("../shared/footer.php"); ?>
</body>

</html>