<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Ulangan</title>
    <?php include("../shared/link.php") ?>
</head>
<body class="bg-subtle">
    <!-- navbar -->
    <?php include("../shared/header.php") ?>
    <main class="min-h-screen bg-subtle">
        <!-- judul -->
        <div class="pt-10 text-center">            
            <h1 class="font-bold text-5xl text-shadow-2xs text-shadow-gray-200 text-main capitalize">ulangan</h1>
            <p class="mt-1 font-normal text-gray-500 capitalize">pilih gim yang ingin kamu mainkan disini</p>
        </div>
        <div class="mt-10 mx-6 lg:m-10 lg:mx-20 flex justify-center">
            
            <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center mb-20">
                <?php for($i = 1; $i <= 7; $i++): ?>
                    <!-- game card 1 -->
                    <div class="flex justify-center items-center">
                        <div class="bg-white p-2  rounded-lg min-w-[15rem] shadow">
                            <!-- container gambar game` -->
                            <div class="flex justify-center">
                                <!-- gambar game -->
                                <img src="" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                            </div>
                            <!-- judul dan deskripsi game -->
                            <div class="mb-3 py-2">
                                <h2 class="font-bold text-main text-lg capitalize">bab <?= $i ?></h2>
                                <p class="font-normal text-xs capitalize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, eos?</p>
                            </div>
                            <!-- btn baca -->
                            <a href="">
                                <button class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-main bg-hover-dark active:scale-95 text-white capitalize">
                                    mainkan
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php include("../shared/footer.php") ?>
    <!-- js header -->
    <script src="../script/header.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
</body>
</html>