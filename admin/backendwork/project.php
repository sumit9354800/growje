<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
    header("location:../index.php");
}

require_once("../conn.php");

if (isset($_POST["submit"])) {

    $file = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $file;

    move_uploaded_file($tmp_name, $folder);

    $heading = mysqli_real_escape_string($conn, $_POST["heading"]);
    $title = mysqli_real_escape_string($conn, $_POST["title"]);

    $insert = "INSERT INTO project(image,heading,title)
        VALUES ('$folder','$heading','$title')";

    $result = mysqli_query($conn, $insert);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../src/image/growje-circle-logo.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../src/output.css" />
    <link rel="stylesheet" href=".././src/style.css">
    <link rel="stylesheet" href="../../dist/output.css">
    <title>Back End</title>
    <!-- ✅ GSAP + ScrollTrigger -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script> -->
</head>

<body class="min-h-screen bg-gray-50 text-gray-800 relative overflow-x-hidden">

    <!-- FULL PAGE WRAPPER -->
    <div class="min-h-screen">

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
        <!-- 👉 md se upar content ko sidebar ki width ke barabar margin mil raha hai -->
        <div class="flex flex-col min-h-screen md:ml-64">

            <!-- Top bar for mobile (logo + menu button) -->
            <header class="md:hidden bg-white border-b">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="../index.html">
                        <img class="h-10 w-auto" src="../../src/image/logo.png" alt="">
                    </a>
                    <button id="sidebar-open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                </div>
            </header>

            <!-- MAIN -->
            <main class="flex-1">

                <!-- 🌟 CONTACT SECTION START -->
                <section id="contact"
                    class="relative w-full py-12 sm:py-16 md:py-20 overflow-hidden flex flex-col justify-center items-center bg-gradient-to-b from-gray-50 via-white to-gray-100">

                    <!-- 🌈 Animated Background Orbs -->
                    <div class="absolute inset-0 overflow-hidden pointer-events-none">
                        <div
                            class="absolute top-[-15%] left-[-10%] w-[300px] sm:w-[400px] h-[300px] sm:h-[400px] bg-blue-300 opacity-25 blur-[120px] rounded-full animate-pulse">
                        </div>
                        <div
                            class="absolute bottom-[-20%] right-[-15%] w-[350px] sm:w-[500px] h-[350px] sm:h-[500px] bg-pink-300 opacity-25 blur-[150px] rounded-full animate-pulse">
                        </div>
                    </div>

                    <!-- 📬 Contact Container -->
                    <div
                        class="flex flex-col lg:flex-row justify-between items-center w-[92%] sm:w-[88%] md:w-[85%] xl:w-[80%] mx-auto gap-8 sm:gap-10 md:gap-12 relative z-10">

                        <!-- 🧠 LEFT: Enhanced Form -->
                        <div
                            class="contact-form w-full bg-white/60 backdrop-blur-2xl border border-gray-200 rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] p-5 sm:p-8 md:p-10 hover:shadow-[0_10px_60px_rgba(0,0,0,0.15)] transition-all duration-500">

                            <!-- ✨ Header -->
                            <div class="text-center mb-6">
                                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">Project Home</h3>
                                <p class="mt-1 text-sm text-gray-500">Upload banner image(725x455) with heading &
                                    Title.</p>
                            </div>

                            <form method="post" id="contactForm"
                                class="flex flex-col lg:flex-row flex-wrap items-center justify-center"
                                enctype="multipart/form-data">

                                <!-- File Input -->
                                <div class="relative group w-full lg:w-4/12 p-1">
                                    <i
                                        class="bi bi-image absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl transition-all duration-300 group-focus-within:text-gray-900"></i>
                                    <input name="image" type="file" id="images"
                                        class="w-full pl-12 pr-4 py-3 sm:py-4 bg-white/60 rounded-xl border border-gray-300 text-sm sm:text-base text-gray-900 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all duration-300 placeholder-gray-400 hover:bg-white/90" />
                                </div>

                                <!-- Heading -->
                                <div class="relative group w-full lg:w-4/12 p-1">
                                    <i
                                        class="bi bi-type absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl transition-all duration-300 group-focus-within:text-gray-900"></i>
                                    <input name="heading" type="text" id="heading"
                                        class="w-full pl-12 pr-4 py-3 sm:py-4 bg-white/60 rounded-xl border border-gray-300 text-sm sm:text-base text-gray-900 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all duration-300 placeholder-gray-400 hover:bg-white/90"
                                        placeholder="Heading...">
                                </div>

                                <!-- Title -->
                                <div class="relative group w-full lg:w-4/12 p-1">
                                    <i
                                        class="bi bi-chat-left-text absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl transition-all duration-300 group-focus-within:text-gray-900"></i>
                                    <input type="text" name="title" id="message"
                                        class="w-full pl-12 pr-4 py-3 sm:py-4 bg-white/60 rounded-xl border border-gray-300 text-sm sm:text-base text-gray-900 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all duration-300 placeholder-gray-400 hover:bg-white/90"
                                        placeholder="Type your Title...">
                                </div>
                            </form>

                            <!-- Button row (separate for better wrapping on small screens) -->
                            <div class="mt-4">
                                <button form="contactForm" name="submit" type="submit"
                                    class="relative w-full lg:w-full px-8 py-3 sm:py-4 text-sm sm:text-base font-semibold text-white rounded-full overflow-hidden group">
                                    <span
                                        class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-700 transition-all duration-500 group-hover:from-gray-800 group-hover:to-black"></span>
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        Send <i class="bi bi-send text-lg"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- table -->
                <section class="w-full px-4 sm:px-6 lg:px-8 pb-12">
                    <div class="w-full overflow-x-auto">
                        <div class="min-w-max bg-white shadow-sm rounded-xl border border-gray-200">
                            <table class="w-full text-xs sm:text-sm text-left rtl:text-right text-gray-700">
                                <thead class="text-xs sm:text-sm bg-gray-100 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 font-medium whitespace-nowrap">Id</th>
                                        <th class="px-4 py-3 font-medium whitespace-nowrap">Image</th>
                                        <th class="px-4 py-3 font-medium whitespace-nowrap">Heading</th>
                                        <th class="px-4 py-3 font-medium whitespace-nowrap">title</th>
                                        <th class="px-4 py-3 font-medium whitespace-nowrap">Delete</th>
                                    </tr>
                                </thead>

                                <?php
                                require_once('../conn.php');
                                $select = "SELECT * FROM project";
                                $result = mysqli_query($conn, $select);
                                $id = 1;

                                while ($fetch = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tbody>
                                        <tr class="bg-white border-b border-gray-100">
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                <?= $id++ ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <img src="<?= $fetch['image'] ?>" alt=""
                                                    class="w-20 h-16 object-cover rounded-md">
                                            </td>

                                            <td class="px-4 py-3 message-cell max-w-xs sm:max-w-sm">
                                                <?= $fetch['heading'] ?>
                                            </td>
                                            <td class="px-4 py-3 message-cell max-w-xs sm:max-w-sm">
                                                <?= $fetch['title'] ?>
                                            </td>

                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <a class="inline-block px-4 py-2 rounded-md bg-red-600 text-white text-xs sm:text-sm hover:bg-red-700"
                                                    href='./delete/project-delete.php?id=<?= $fetch["id"] ?>'>Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </section>
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

    <!-- <script src="../../src/script.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script> -->
    <!-- <script src="../../src/gsap.js"></script> -->
</body>

</html>