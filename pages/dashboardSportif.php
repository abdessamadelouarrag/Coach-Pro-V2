<?php
session_start();

require_once "../config/database.php";
require_once "../classes/utilisateur.php";
require_once "../classes/sportif.php";
require_once "../classes/coach.php";
require_once "../classes/reservation.php";
require_once "../classes/seance.php";

$nomusre = $_SESSION['nom'];
$iduser = $_SESSION['id_user'];
$roleuser = $_SESSION['role'];

$db = new Database();
$pdo = $db->connect();
$infosportif = new Sportif($pdo);

$allinfo = $infosportif->infosportif($iduser);

$allcoaches = new Coacha($pdo);
$coaches = $allcoaches->allcoaches();

$sqlGetSportifId = "SELECT id_sportif FROM sportif WHERE id_user = :iduser";
$stmtGetSportifId = $pdo->prepare($sqlGetSportifId);
$stmtGetSportifId->execute([':iduser' => $iduser]);
$sportifData = $stmtGetSportifId->fetch(PDO::FETCH_ASSOC);

if ($sportifData) {
  $sportifId = $sportifData['id_sportif'];

  $reservations = new Reservation($pdo);
  $allreservation = $reservations->allresrvation($sportifId);
} else {

  $sqlCreateSportif = "INSERT INTO sportif (id_user) VALUES (:iduser)";
  $stmtCreateSportif = $pdo->prepare($sqlCreateSportif);
  $stmtCreateSportif->execute([':iduser' => $iduser]);
  $sportifId = $pdo->lastInsertId();

  $allreservation = [];
}

if(isset($_GET['delete'])){
  $deletereserve = $_GET['delete'];

  $delete = new Seances($pdo);
  $delete->deleteseances($deletereserve);
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Dashboard Sportif</title>
</head>

<body class="bg-slate-950 text-slate-100">

  <!-- Topbar -->
  <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center">
          <span class="text-emerald-400 font-bold">CP</span>
        </div>
        <div>
          <p class="text-sm text-slate-400">CoachPro</p>
          <h1 class="text-lg font-semibold">Dashboard Sportif</h1>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <div class="hidden sm:block text-right">
          <p class="text-sm font-medium"></p>
          <p class="text-xs text-slate-400"></p>
        </div>
        <a href="login.php" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-sm">
          Logout
        </a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-7xl px-4 py-8 grid grid-cols-1 lg:grid-cols-12 gap-6">

    <!-- Left -->
    <section class="lg:col-span-8 space-y-6">

      <!-- Welcome -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <p class="text-slate-400 text-sm">Bienvenue 👋</p>
        <h2 class="text-2xl font-semibold mt-1">
          <span class="text-blue-600 uppercase"><?= $nomusre ?></span>, prêt pour ta prochaine séance ?
        </h2>
        <p class="text-slate-400 mt-2">
          Ici tu peux trouver des coachs, réserver des séances, et suivre tes réservations.
        </p>

        <div class="mt-5 flex flex-wrap gap-3">
          <a href="coachs.php" class="px-4 py-2 rounded-xl bg-emerald-500 text-slate-950 font-medium hover:bg-emerald-400">
            Trouver un coach
          </a>
          <a href="reservations.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700">
            Mes réservations
          </a>
        </div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($coaches as $row) {
          echo "<div class='rounded-3xl border border-slate-800 bg-slate-900/40 p-5'>
              <div class='flex items-center gap-4'>
                <img
                  src='https://i.pinimg.com/1200x/89/5f/e1/895fe1c3bf5689baa50ccfb57bded623.jpg' alt='Coach'
                  class='w-14 h-14 rounded-2xl object-cover border border-slate-700' />
                <div>
                  <p class='text-sm text-slate-400'>Coach</p>
                  <h3 class='text-sm font-bold text-white leading-6'>Nom : " . $row['nom'] . "</h3>
                  <h5 class='text-sm text-blue-300 font-semibold'>Disipline : " . $row['specialite'] . "</h5>
                </div>
              </div>
              <!-- button reserver -->
              <div class='mt-5'>
                <a
                  href='reservationpage.php?coach_id=" . $row['id_coach'] . "'
                  class='inline-flex w-full items-center justify-center rounded-2xl bg-emerald-500 px-4 py-2.5
                        text-sm font-semibold text-white  hover:bg-emerald-600 transition'>
                  Réserver
                </a>
              </div>
  
            </div>";
        }
        ?>
      </div>

      <!-- Upcoming sessions table (dummy) -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <div class="flex items-center justify-between gap-3">
          <h3 class="text-lg font-semibold">Prochaines réservations</h3>
          <a class="text-sm text-emerald-400 hover:underline" href="reservations.php">Voir tout</a>
        </div>

        <div class="mt-4 overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="text-slate-400">
              <tr class="border-b border-slate-800">
                <th class="py-3 text-left font-medium">Coach</th>
                <th class="py-3 text-left font-medium">Discipline</th>
                <th class="py-3 text-left font-medium">Date</th>
                <th class="py-3 text-left font-medium">Heure</th>
                <th class="py-3 text-left font-medium">Status</th>
                <th class="py-3 text-left font-medium flex justify-center">Supprimer</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allreservation as $row): ?>
                <tr class="border-b border-slate-800/70">
                  <td class="py-3"><?= $row['nom_coach'] ?></td>
                  <td class="py-3"><?= $row['specialite'] ?></td>
                  <td class="py-3"><?= $row['date_reservation'] ?></td>
                  <td class="py-3"><?= $row['heure_debut'] ?></td>
                  <td class="py-3">
                    <span class="
                    px-2 py-1 rounded-lg border text-sm font-semibold
                    <?= $row['status'] === 'accepter' ? 'bg-green-500/20 text-green-500 border-green-500/30' : ($row['status'] === 'refuser'
                    ? 'bg-red-500/20 text-red-500 border-red-500/30': 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30') ?>">
                      <?= ucfirst($row['status']) ?>
                    </span>
                  </td>

                  <td class="py-3 text-red-600 flex justify-center bg-red-600/20">
                    <a href="?delete=<?= $row['id_reservation'] ?>">
                      <i class="fas fa-trash-can"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Right -->
    <aside class="lg:col-span-4 space-y-6">

      <!-- Profile card -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Mon profil</h3>
        <div class="mt-4 flex items-center gap-3">
          <div class="h-12 w-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
            <img src="https://i.pinimg.com/736x/eb/b9/a7/ebb9a75cd87a6fa56342ff2ea683b5d0.jpg" class="object-cover" alt="">
          </div>
          <div>
            <p class="font-medium">Nom : <?= $allinfo['nom'] ?></p>
            <p class="font-medium">Prenom : <?= $allinfo['prenom'] ?></p>
          </div>
        </div>
      </div>

      <!-- Tips -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Conseils</h3>
        <ul class="mt-4 space-y-3 text-sm text-slate-300">
          <li class="flex gap-2"><span class="text-emerald-400">✔</span> Réserve seulement quand le coach est disponible.</li>
          <li class="flex gap-2"><span class="text-emerald-400">✔</span> Complète ton profil pour de meilleures recommandations.</li>
          <li class="flex gap-2"><span class="text-emerald-400">✔</span> Vérifie tes réservations avant la date.</li>
        </ul>
      </div>

    </aside>
  </main>

</body>

</html>