<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Ulangan Edit </title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>
<body>
    <!-- sidebar -->
    <?php include("../sidebar/sidebarUlangan.php") ?>
    <!-- container -->
    <div class="min-h-screen bg-subtle">
        <!-- wrapper -->
        <div id="content" class="flex-1 transition-all duration-300">
            <!-- wrapper konten-->
            <div class="p-5">
                <!-- header -->
                <header>
                    <nav class="flex justify-between gap-5">
                        <div class="flex flex-col text-start">
                            <h1 class="text-lg md:text-3xl font-bold  capitalize">ulangan</h1>
                            <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                        </div>
                        <?php include("../shared/headerGuru.php") ?>
                    </nav>
                </header>
            </div>
        </div>
    </div>
    <!-- js notif -->
    <script src="../script/notif.js"></script>
    <!-- js sidebar guru -->
    <script src="../script/sidebarGuru.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
</body>
</html>