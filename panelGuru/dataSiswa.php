<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Data Siswa</title>
    <?php include("../shared/link.php"); ?>
    <?php include("../shared/sidebarGuru_css.php"); ?>
</head>
<body class="bg-gray-50">
    <main class="min-h-screen">
        <!-- sidebar -->
        <?php include("../sidebar/sidebarDataSiswa.php") ?>

        <!-- konten -->
         <div id="content" class="flex-1 transition-all duration-300 p-5">
            <!-- header -->
            <header>
                <nav class="flex justifu-between gap-5">
                    <!-- text halaman -->
                    <div class="flex flex-col text-start">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">data siswa</h1>
                        <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                    </div>
                </nav>
            </header>
         </div>
    </main>
    <!-- javascript -->
    <?php include("../script/sidebarGuru.php") ?>

</body>
</html>