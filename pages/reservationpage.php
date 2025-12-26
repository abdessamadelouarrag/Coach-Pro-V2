<?php
session_start();

require_once "../config/database.php";
require_once "../classes/coach.php";
require_once "../classes/seance.php";
require_once "../classes/utilisateur.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'sportif') {
    header("Location: dashboardCoach.php");
    exit();
}

$id_user = $_SESSION['id_user'];

$db = new Database();
$pdo = $db->connect();

$coachId = $_GET['coach_id'];
if ($coachId <= 0) {
    header("Location: dashboardSportif.php");
    exit;
}

$userModel = new Utilisateur($pdo);
$coachInfo = $userModel->getCoachByCoachId($coachId);

if (!$coachInfo) {
    die("Coach not found");
}
$seanceModel = new Seances($pdo);
$seances = $seanceModel->fetchseances($coachId);

if (isset($_GET['seance_id'])) {
    $seance_id = $_GET['seance_id'];
    $seancesreserver = $seanceModel->toreserve($seance_id);
}

if (isset($_GET['date'], $_GET['hd'], $_GET['hf'])) {
    $date  = $_GET['date'];
    $hd    = $_GET['hd'];
    $hf    = $_GET['hf'];

    $sportifId = $_SESSION['id_user'];

    $ok = $seanceModel->reserveSeanceSimple($date, $hd, $hf, $coachId, $sportifId);

    header("Location: reservationpage.php?coach_id=$coachId");
    exit;
}


?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Réservation</title>
</head>

<body class="bg-slate-950 text-slate-100">

    <!-- Topbar -->
    <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="h-10 w-10 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center">
                    <span class="text-emerald-400 font-bold">CP</span>
                </div>
                <div>
                    <p class="text-sm text-slate-400">CoachPro</p>
                    <h1 class="text-lg font-semibold">Réserver une séance</h1>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-medium">Sportif Name</p>
                    <p class="text-xs text-slate-400">sportif@email.com</p>
                </div>
                <a href="login.php"
                    class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-sm">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left -->
        <section class="lg:col-span-8 space-y-6">

            <!-- Coach info -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
                <div class="flex items-start gap-4">
                    <img
                        src="https://i.pinimg.com/1200x/89/5f/e1/895fe1c3bf5689baa50ccfb57bded623.jpg"
                        alt="Coach" class="w-16 h-16 rounded-2xl object-cover border border-slate-700" />

                    <div class="flex-1">
                        <p class="text-slate-400 text-sm">Coach sélectionné</p>
                        <h2 class="text-2xl font-semibold mt-1">NOM : <span class="uppercase text-lg text-blue-600"><?= $coachInfo['nom'] ?></span></h2>

                        <div class="mt-2 flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1 rounded-xl bg-emerald-500/15 text-emerald-300 border border-emerald-500/20 text-sm">
                                Discipline: <?= $coachInfo['specialite'] ?>
                            </span>
                            <span class="px-3 py-1 rounded-xl bg-slate-800 text-slate-200 border border-slate-700 text-sm">
                                Exp: <?= $coachInfo['experiences'] ?>
                            </span>
                        </div>

                        <p class="mt-4 text-slate-300 text-sm leading-6">
                            <?= $coachInfo['bio'] ?>
                        </p>
                    </div>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="dashboardSportif.php"
                        class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700">
                        ← Retour aux coachs
                    </a>
                </div>
            </div>

            <!-- Availability -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
                <div class="flex items-center justify-between gap-3">
                    <h3 class="text-lg font-semibold">Disponibilités</h3>
                    <span class="text-sm text-slate-400"><?= count($seances) ?> créneaux disponibles</span>
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <?php if (empty($seances)): ?>
                        <div class="col-span-full rounded-3xl border border-slate-800 bg-slate-950/30 p-5">
                            <p class="text-slate-300">Aucune séance disponible pour ce coach.</p>
                        </div>
                    <?php else: ?>

                        <?php foreach ($seances as $s): ?>
                            <div class="rounded-3xl border border-slate-800 bg-slate-950/30 p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-slate-400">Date</p>
                                        <p class="text-base font-semibold"><?= htmlspecialchars($s['date_seance']) ?></p>
                                    </div>

                                    <span class="px-2 py-1 rounded-lg bg-emerald-500/15 text-emerald-300 border border-emerald-500/20 text-xs">
                                        Disponible
                                    </span>
                                </div>

                                <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900/30 p-3">
                                        <p class="text-slate-400">Début</p>
                                        <p class="font-medium"><?= htmlspecialchars($s['heure_debut']) ?></p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900/30 p-3">
                                        <p class="text-slate-400">Fin</p>
                                        <p class="font-medium"><?= htmlspecialchars($s['heure_fin']) ?></p>
                                    </div>
                                </div>

                                <!-- later you can make this a form to reserve -->
                                <a href="reservationpage.php?coach_id=<?= $coachId ?>&date=<?= $s['date_seance'] ?>&hd=<?= $s['heure_debut'] ?>&hf=<?= $s['heure_fin'] ?>"
                                    class="mt-4 inline-flex w-full items-center justify-center rounded-2xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-slate-950 hover:bg-emerald-400 transition">
                                    Réserver ce créneau
                                </a>

                            </div>
                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </div>

        </section>

        <!-- Right -->
        <aside class="lg:col-span-4 space-y-6">

            <!-- Profile card -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
                <h3 class="text-lg font-semibold">Mon profil</h3>
                <div class="mt-4 flex items-center gap-3">
                    <div
                        class="h-12 w-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
                        <img src="https://i.pinimg.com/736x/eb/b9/a7/ebb9a75cd87a6fa56342ff2ea683b5d0.jpg"
                            class="object-cover" alt="">
                    </div>
                    <div>
                        <p class="font-medium">Nom : Sportif</p>
                        <p class="font-medium">Prenom : User</p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
                <h3 class="text-lg font-semibold">Conseils</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-300">
                    <li class="flex gap-2"><span class="text-emerald-400">✔</span> Réserve seulement quand le coach est disponible.</li>
                    <li class="flex gap-2"><span class="text-emerald-400">✔</span> Clique sur un créneau pour réserver.</li>
                    <li class="flex gap-2"><span class="text-emerald-400">✔</span> Suis tes réservations dans “Mes réservations”.</li>
                </ul>
            </div>

        </aside>
    </main>

</body>

</html>