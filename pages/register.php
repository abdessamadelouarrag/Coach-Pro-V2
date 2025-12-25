<?php
session_start();

require_once "../config/database.php";
require_once "../classes/utilisateur.php";
require_once "../classes/coach.php";
require_once "../classes/sportif.php";



$db = new Database();
$pdo = $db->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user = new Utilisateur($pdo);

    $user->setnom($_POST['nom']);
    $user->setPrenom($_POST['prenom']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setRole($_POST['role']);


    $user_id = $user->insertUser();

    if ($user->getRole() === "coach") {

        $disipline = $_POST['discipline'];
        $experience = $_POST['experience'];
        $description = $_POST['description'];

        $coach = new Coacha($pdo);
        $coach->setspecialite($disipline);
        $coach->setexperience($experience);
        $coach->setdescription($description);
        $coach->setiduser($user_id);

        $insertcoach = $coach->insertCoach();

        if($insertcoach){
            $_SESSION['id_coach'] = $insertcoach['id_coach'];
        }
    }

    echo "connect good !!";
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-950 flex items-center justify-center text-slate-100">

    <!-- Card -->
    <div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">

        <!-- Title -->
        <h1 class="text-2xl font-semibold text-center mb-2">
            Create Account
        </h1>
        <p class="text-slate-400 text-center mb-6">
            Join CoachPro platform
        </p>

        <!-- Form -->
        <form method="POST" class="space-y-4">

            <!-- Nom -->
            <input
                type="text"
                name="nom"
                placeholder="Nom"
                required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">

            <!-- Prenom -->
            <input
                type="text"
                name="prenom"
                placeholder="Prénom"
                required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">

            <!-- Email -->
            <input
                type="email"
                name="email"
                placeholder="Email"
                required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">

            <!-- Password -->
            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">

            <!-- Role -->
            <select
                name="role"
                id="role"
                required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                <option value="">-- Choose role --</option>
                <option value="coach">Coach</option>
                <option value="sportif">Sportif</option>
            </select>

            <!-- Coach Fields -->
            <div id="coachFields" class="hidden space-y-3">

                <input
                    type="text"
                    name="discipline"
                    placeholder="Discipline"
                    class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700">

                <input
                    type="text"
                    name="experience"
                    placeholder="Experience"
                    class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700">

                <textarea
                    name="description"
                    placeholder="Description"
                    class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700"></textarea>
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full py-2 rounded-xl bg-emerald-500 text-slate-950 font-semibold hover:bg-emerald-400 transition">
                Register
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-slate-400 mt-6">
            Already have an account?
            <a href="login.php" class="text-emerald-400 hover:underline">
                Login
            </a>
        </p>
    </div>

    <!-- JS -->
    <script>
        const roleSelect = document.getElementById('role');
        const coachFields = document.getElementById('coachFields');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'coach') {
                coachFields.classList.remove('hidden');
            } else {
                coachFields.classList.add('hidden');
            }
        });
    </script>

</body>

</html>