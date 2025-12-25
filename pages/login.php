<?php
session_start();

require_once "../config/database.php";
require_once "../classes/utilisateur.php";

$db = new Database();
$pdo = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userlogin = new Utilisateur($pdo);

    $user = $userlogin->login($email, $password);


    if ($user === false) {
        echo "Email ou mot de passe incorrect";
    } else {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];

        if ($user['role'] === 'coach') {
            $idcoach = $userlogin->idcoach($_SESSION['id_user']);

            $_SESSION['idcoach'] = $idcoach['id_coach'];
            header("Location: dashboardCoach.php");
            exit;
        } else {
            header("Location: dashboardSportif.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-950 flex items-center justify-center text-slate-100">

    <!-- Card -->
    <div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">

        <!-- Title -->
        <h1 class="text-2xl font-semibold text-center mb-2">
            Login
        </h1>
        <p class="text-slate-400 text-center mb-6">
            Connect to your account
        </p>

        <!-- Form -->
        <form action="" method="POST" class="space-y-5">

            <!-- Email -->
            <div>
                <label class="block text-sm mb-1 text-slate-300">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="example@email.com"
                    class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm mb-1 text-slate-300">
                    Mot de passe
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full py-2 rounded-xl bg-emerald-500 text-slate-950 font-semibold hover:bg-emerald-400 transition">
                Login
            </button>

        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-slate-400 mt-6">
            Don’t have an account?
            <a href="register.php" class="text-emerald-400 hover:underline">
                Sign up
            </a>
        </p>

    </div>

</body>

</html>