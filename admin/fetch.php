<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
    header("location:index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Details</title>
    <!-- Tailwind CDN (for quick demo) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex">

        <!-- 🧭 SIDEBAR -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Logo -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <a href="../index.html" class="flex items-center gap-2">
                    <img class="h-10 w-auto" src="../../src/image/logo.png" alt="">
                </a>
                <!-- Close button (mobile) -->
                <button id="sidebar-close" class="md:hidden p-2 rounded-md hover:bg-gray-100">
                    <i class="bi bi-x-lg text-gray-600 text-lg"></i>
                </button>
            </div>

            <!-- Nav Links -->
            <nav class="px-4 py-4 space-y-2 text-sm">
                <a href="details-home.php"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="bi bi-image"></i>
                    <span>Details Home</span>
                </a>
                <a href="home.php" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="bi bi-image"></i>
                    <span>Service Home</span>
                </a>
                <a href="project.php" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-900 text-white">
                    <i class="bi bi-image"></i>
                    <span>Project Home</span>
                </a>

                <a href="../fetch.php"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="bi bi-card-list"></i>
                    <span>Details</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="mt-auto px-4 pb-4 border-t pt-4">
                <a href="../logout.php"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </a>
            </div>
        </aside>

        <!-- 🔲 Mobile backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 z-20 bg-black/40 hidden md:hidden"></div>

        <!-- 📦 MAIN CONTENT WRAPPER -->
        <div class="flex flex-col min-h-screen md:ml-64">

            <!-- Top bar for mobile -->
            <header class="md:hidden bg-white border-b">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="../index.html">
                        <img class="h-10 w-auto" src="../src/image/logo.png" alt="">
                    </a>
                    <button id="sidebar-open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- MAIN -->
            <main class="w-full mx-auto p-4 sm:p-6 lg:p-8 flex-1">

                <h1 class="text-xl sm:text-2xl font-semibold mb-4">User Details</h1>

                <div class="w-full overflow-x-auto">
                    <div class="min-w-max bg-white shadow-sm rounded-xl border border-gray-200">
                        <table class="w-full text-xs sm:text-sm text-left rtl:text-right text-gray-700">
                            <thead class="text-xs sm:text-sm bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Id</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Date</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Full Name</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Email</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Phone</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Message</th>
                                    <th class="px-4 py-3 font-medium whitespace-nowrap">Delete</th>
                                </tr>
                            </thead>

                            <?php
                            require_once('conn.php');
                            $select = "SELECT * FROM growjetd";
                            $result = mysqli_query($conn, $select);
                            $id = 1;

                            while ($fetch = mysqli_fetch_assoc($result)) {
                                ?>
                                <tbody>
                                    <tr class="bg-white border-b border-gray-100 flex flex-col-reverse">
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <?= $id++ ?>
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <?= $fetch["date"] ?>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <?= $fetch["name"] ?>
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <?= $fetch["email"] ?>
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <?= $fetch["phone"] ?>
                                        </td>

                                        <td class="px-4 py-3 message-cell max-w-xs sm:max-w-sm">
                                            <?= $fetch["message"] ?>
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a class="inline-block px-4 py-2 rounded-md bg-red-600 text-white text-xs sm:text-sm hover:bg-red-700"
                                                href='backendwork/delete/delete.php?id=<?= $fetch["id"] ?>'>Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar + message JS -->
    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const openBtn = document.getElementById('sidebar-open');
            const closeBtn = document.getElementById('sidebar-close');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }

            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);
        })();

        // Break message after 10 words
        document.querySelectorAll('.message-cell').forEach(cell => {
            const words = cell.innerText.trim().split(/\s+/);
            let result = [];

            for (let i = 0; i < words.length; i++) {
                result.push(words[i]);
                if ((i + 1) % 10 === 0) {
                    result.push("\n");
                }
            }

            cell.innerText = result.join(" ");
        });
    </script>

</body>

</html>