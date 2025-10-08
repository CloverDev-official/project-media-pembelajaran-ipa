<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Materi Edit</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>

<body>
    <!-- sidebar -->
    <?php include("../sidebar/sidebarGim.php") ?>
    <!-- container -->
    <div class="min-h-screen bg-subtle">
        <!-- wrapper -->
        <div id="content" class="flex-1 transition-all duration-300">
            <div class="p-5">
                <!-- header -->
                <header>
                    <nav class="flex justify-between gap-5">
                        <div class="flex flex-col text-start">
                            <h1 class="text-lg md:text-3xl font-bold capitalize">edit game</h1>
                            <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                        </div>
                        <?php include("../shared/headerGuru.php") ?>
                    </nav>
                </header>   
                <!-- container konten -->
                <main class="mt-10">
                    <!-- wrapper -->
                    <div class="bg-white rounded-lg p-5 shadow">
                        <form action="# method="post" class="flex flex-col gap-4">
                            <!-- soal -->
                            <div class="flex flex-col gap-2">
                                <label class="capitalize font-bold text-main text-lg">soal game :</label>
                                <input type="text" class="border rounded-md p-2" placeholder="ketik soal untuk game di sini" required>
                            </div>
                            <!-- komponen -->
                            <div class="flex flex-col gap-2">
                                <label class="capitalize font-bold text-main text-lg">komponen 1 :</label>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa teks (opsional)</label>
                                    <input type="text" class="border rounded-md p-2" placeholder="ketik component untuk game di sini" required>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa gambar (opsional)</label>
                                    <input type="file" class="border rounded-md p-2">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="capitalize font-bold text-main text-lg">komponen 2 :</label>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa teks (opsional)</label>
                                    <input type="text" class="border rounded-md p-2" placeholder="ketik component untuk game di sini" required>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa gambar (opsional)</label>
                                    <input type="file" class="border rounded-md p-2">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="capitalize font-bold text-main text-lg">komponen 3 :</label>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa teks (opsional)</label>
                                    <input type="text" class="border rounded-md p-2" placeholder="ketik component untuk game di sini" required>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa gambar (opsional)</label>
                                    <input type="file" class="border rounded-md p-2">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="capitalize font-bold text-main text-lg">komponen 4 :</label>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa teks (opsional)</label>
                                    <input type="text" class="border rounded-md p-2" placeholder="ketik component untuk game di sini" required>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="capitalize font-semibold">pilihan berupa gambar (opsional)</label>
                                    <input type="file" class="border rounded-md p-2">
                                </div>
                            </div>
                            <!-- btn submit -->
                            <input type="submit" class="capitalize rounded-md px-3 py-2 shadow text-white bg-green-600 transition-all duration-150 hover:bg-green-700" value="simpan">
                        </form>
                    </div>
                </main>

            </div>
            <!-- footer -->
            <?php
                include("../shared/footer.php");
            ?>
        </div>
    </div>
    <!-- header -->
    <script src="../script/notif.js"></script>
    <!-- js sidebar -->
    <script src="../script/sidebarGuru.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
</body>

</html>