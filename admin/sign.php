<?php
require_once('conn.php');

if (isset($_POST['signup'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user already exist
    $check = mysqli_query($conn, "SELECT * FROM logintd WHERE username='$username' AND password='$password' ");

    if (mysqli_num_rows($check) > 0) {

        echo "❌ Username already exists";

    } else {

        // Insert new user
        $query = mysqli_query($conn, "INSERT INTO logintd(username, password) 
        VALUES ('$username', '$password')");

        if ($query) {
            echo "✔ User registered successfully";
        } else {
            echo "❌ Error inserting user";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="src/image/growje-circle-logo.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/output.css" />
    <link rel="stylesheet" href="../src/style.css">
    <title>Contact Us | Growje</title>
    <!-- ✅ GSAP + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
</head>

<body class="min-h-screen bg-white relative overflow-x-hidden">



    <!-- MAIN Star -->

    <main>
        <!-- 🌟 CONTACT SECTION START -->
        <section id="contact"
            class="relative w-full py-24 sm:py-28 md:py-32 overflow-hidden flex flex-col justify-center items-center">

            <!-- 📬 Contact Container -->
            <div
                class="flex flex-col lg:flex-row justify-center items-center w-[92%] sm:w-[88%] md:w-[85%] xl:w-[80%] mx-auto gap-12 sm:gap-20 relative z-10">

                <div
                    class=" w-full lg:w-1/2 bg-white/60 backdrop-blur-2xl border border-gray-200 rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] p-6 sm:p-10 hover:shadow-[0_10px_60px_rgba(0,0,0,0.15)] transition-all duration-500">

                    <!-- ✨ Header -->
                    <div class="text-center mb-6">
                        <h3 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-20">Sign Up</h3>
                        <br>
                        <form action="" method="post" id="contactForm" class="flex flex-col gap-8 ">

                            <!-- Email -->
                            <div class="relative group">
                                <i
                                    class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl transition-all duration-300 group-focus-within:text-gray-900"></i>
                                <input name="username" type="text" id="username"
                                    class="w-full pl-12 pr-4 py-4 bg-white/60 rounded-xl border border-gray-300 text-gray-900 text-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all duration-300 placeholder-gray-400 hover:bg-white/90"
                                    placeholder="Email Address" />
                            </div>

                            <!-- Name -->
                            <div class="relative group">
                                <i
                                    class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl transition-all duration-300 group-focus-within:text-gray-900"></i>
                                <input name="password" type="password" id="name"
                                    class="w-full pl-12 pr-4 py-4 bg-white/60 rounded-xl border border-gray-300 text-gray-900 text-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all duration-300 placeholder-gray-400 hover:bg-white/90"
                                    placeholder="Password" />
                            </div>

                            <!-- Button -->
                            <button name="signup" type="submit"
                                class="relative w-full py-4 text-lg sm:text-xl font-semibold text-white rounded-full overflow-hidden group">
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-700 transition-all duration-500 group-hover:from-gray-800 group-hover:to-black"></span>
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Send Message <i class="bi bi-send text-lg"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
        </section>


        <!-- 🌟 CONTACT SECTION END -->
    </main>

    <!-- END MAIN -->



    <script src="../src/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="../src/gsap.js"></script>
</body>

</html>