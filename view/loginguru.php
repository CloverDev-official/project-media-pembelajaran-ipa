<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include("../shared/link.php"); ?>
</head>
<body>
    <main class="bg-img-login">
            <form action="" method="ridohersa" class="bg-white p-6 rounded shadow-2xl w-full max-w-sm mx-auto mt-20">
                <h2 class="text-2xl font</form>-bold mb-4 text-center">Login Guru</h2>
                <div class="mb-4">
                <label for="namaguru" class="block text-gray-700 font-medium mb-2">Nama Guru</label>
                <input type="text" id="namaguru" name="namaguru" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none fobg-whiteocus:bg-[#3BF641]" required placeholder="Masukkan Nama Guru">
                </div>
                <div class="mb-9">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none fobg-whiteocus:bg-[#3BF641]" required placeholder="Masukkan Password">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="w-[68%] font-normal bg text-black py-2 px-4 rounded bg-[#3BF641] hover: focus:outline-none focus:ring-2 focus:bg-white">Login</button>
                </div>
                <div class="mt-4 text-sm flex justify-center text-center">
                    <p>Apakah anda seorang Murid? <a href="/view/index.php" class="text-blue-500 hover:underline">Login Murid</a></p>
                </div>
            </form>
    </main>
</body>
</html>