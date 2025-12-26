<?php
session_start();
require_once "../classes/seance.php";
require_once "../classes/coach.php";
require_once "../classes/reservation.php";

$nomcoach =  $_SESSION['nom'];
$rolecoach = $_SESSION['role'];
$id_user = $_SESSION['id_user'];
$id_coach = $_SESSION['idcoach'];
// echo $id_coach;

$db = new Database();
$pdo = $db->connect();
$dispoModel = new Seances($pdo);

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $dispoModel = new Seances($pdo);

  $date  = $_POST['date'] ?? '';
  $heure_debut = $_POST['heure_debut'] ?? '';
  $heure_fin   = $_POST['heure_fin'] ?? '';

  $ok = $dispoModel->createDispo($date, $heure_debut, $heure_fin, $id_coach);

  if ($ok) {
    header("Location: dashboardCoach.php");
    exit();
  }
}

//parte fetch dispo
$all = $dispoModel->fetchseances($id_coach);

if (isset($_GET['delete'])) {
  $iddelet = $_GET['delete'];

  $dlt = $dispoModel->deletseances($iddelet);

  if ($dlt) {
    header("Location: dashboardCoach.php");
    exit();
  }
}

$infocoach = new Coacha($pdo);
$info = $infocoach->infocoach($id_coach);

$allreservation = new Reservation($pdo);
$resrvations = $allreservation->reservationcoach($id_coach);


if (isset($_GET['accepter'])) {
  $idreservation = $_GET['accepter'];

  $allres = new Reservation($pdo);
  $accepter = $allres->updatestatus($idreservation);
}

if (isset($_GET['refuser'])) {
  $idreservations = $_GET['refuser'];

  $allrese = new Reservation($pdo);
  $accepter = $allrese->refuserreservation($idreservations);
}

?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Dashboard Coach</title>
</head>

<body class="bg-slate-950 text-slate-100">

  <!-- Topbar -->
  <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-2xl bg-indigo-500/15 border border-indigo-500/30 flex items-center justify-center">
          <span class="text-indigo-300 font-bold">CP</span>
        </div>
        <div>
          <p class="text-sm text-slate-400">CoachPro</p>
          <h1 class="text-lg font-semibold">Dashboard Coach</h1>
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
        <p class="text-slate-400 text-sm">Bienvenue Coach 👋</p>
        <h2 class="text-2xl font-semibold mt-1">
          <span class="font-bold text-3xl text-blue-600 uppercase">"<?= $nomcoach ?>"</span>, gère tes disponibilités et tes réservations
        </h2>
        <p class="text-slate-400 mt-2">
          Ajoute tes créneaux, confirme/refuse des demandes, et suis ton planning.
        </p>

        <div class="mt-5 flex flex-wrap gap-3">
          <button id="openModal"
            class="px-4 py-2 rounded-xl bg-indigo-500 text-slate-950 font-medium hover:bg-indigo-400">
            + Ajouter une disponibilité
          </button>

        </div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Demandes</p>
          <p class="text-3xl font-semibold mt-2"><?= count($resrvations) ?></p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Séances confirmées</p>
          <p class="text-3xl font-semibold mt-2">0</p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Note moyenne</p>
          <p class="text-3xl font-semibold mt-2">4.7</p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
      </div>

      <!-- Planning (dummy) -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <div class="flex items-center justify-between gap-3">
          <h3 class="text-lg font-semibold">Mes Reservations</h3>
          <a class="text-sm text-indigo-300 hover:underline" href="disponibilites.php">Gérer</a>
        </div>
        <?php foreach ($resrvations as $row): ?>
          <div class="mt-4 space-y-3">
            <div class="p-4 rounded-2xl border border-slate-800 bg-slate-950/30 flex items-center justify-between gap-4">
              <div>
                <p class="font-medium"><?= $row['date_reservation'] ?></p>
                <p class="text-sm text-slate-400"><?= $row['heure_debut'] ?> → <?= $row['heure_fin'] ?></p>
              </div>
              <div class="flex items-center gap-3">
                <span class="px-2 py-1 rounded-lg border text-xs font-semibold
              <?= $row['status'] === 'accepter'
            ? 'bg-green-500/20 text-green-500 border-green-500/30'
            : ($row['status'] === 'refuser'
              ? 'bg-red-500/20 text-red-500 border-red-500/30'
              : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30') ?>">
                  <?= ucfirst($row['status']) ?>
                </span>

                <button class="px-3 py-1.5 rounded-lg bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 text-xs hover:bg-emerald-500/25 transition">
                  <a href="?accepter=<?= $row['id_reservation'] ?>">
                    <i class="fas fa-check"></i>
                  </a>
                </button>
                <button class="px-3 py-1.5 rounded-lg bg-red-500/15 text-red-300 border border-red-500/30 text-xs hover:bg-red-500/25 transition">
                  <a href="?refuser=<?= $row['id_reservation'] ?>">
                    <i class="fas fa-x"></i>
                  </a>
                </button>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </section>

    <!-- Right -->
    <aside class="lg:col-span-4 space-y-6">

      <!-- Profile -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Mon profil coach</h3>

        <div class="mt-4 flex items-center gap-3">
          <div class="h-12 w-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
            <img src="https://i.pinimg.com/736x/96/36/c9/9636c978ed99793b3b11c04ba7fe9267.jpg" alt="">
          </div>
          <div>
            <p class="font-medium">Nom : <?= $nomcoach ?></p>
            <p class="text-xs text-slate-400">Disipline : <?= $info['specialite'] ?></p>
            <p class="text-xs text-slate-400">Experiences : <?= $info['experiences'] ?></p>
            <p class="text-xs text-slate-400">Bio : <?= $info['bio'] ?></p>
          </div>
        </div>
      </div>

      <!-- Quick actions -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Mes Disponibilite</h3>
        <div class="mt-4 grid gap-3 border-[1px] border-blue-700/20 p-3 rounded-xl">
          <?php
          if (!empty($all)) {
            foreach ($all as $row) {
              echo "
                <div class='p-4 rounded-2xl border border-slate-800 bg-slate-950/30 flex items-center justify-between gap-4'>
                  <!-- Infos -->
                  <div>
                    <p class='font-medium text-slate-100'>" . $row['date_seance'] . "</p>
                    <p class='text-sm text-slate-400'>Heure Debut : <span>" . $row['heure_debut'] . "</span></p>
                    <p class='text-sm text-slate-400'>Heure fin : <span>" . $row['heure_fin'] . "</p>
                  </div>
      
                  <!-- Actions -->
                  <div class='flex items-center gap-2'>
                  <a href='?delete=" . $row['id_seances'] . "'>
                    <button class='px-3 py-1.5 rounded-lg bg-red-500/15 text-red-300 border border-red-500/30 text-xs hover:bg-red-500/25 transition'>
                      <i class='fas fa-trash'></i>
                    </button>
                  </a>
                  </div>
                </div> ";
            }
          } else {
            echo "<p class='text-center text-gray-600'>----- Vide disponibilite -----</p>";
          }
          ?>

        </div>
      </div>

    </aside>

    <!--place pop-->
    <!-- Modal Backdrop -->
    <div id="modalBackdrop"
      class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50">

      <!-- Modal Card -->
      <div class="w-full max-w-lg mx-4 rounded-3xl border border-slate-800 bg-slate-900/80 p-6 shadow-2xl">

        <!-- Header -->
        <div class="flex items-start justify-between gap-4">
          <div>
            <h3 class="text-lg font-semibold">Ajouter une disponibilité</h3>
            <p class="text-sm text-slate-400 mt-1">Choisis une date et un créneau horaire.</p>
          </div>

          <button id="closeModal"
            class="h-10 w-10 rounded-2xl bg-slate-800 border border-slate-700 hover:bg-slate-700 flex items-center justify-center">
            <i class="fas fa-x text-slate-200"></i>
          </button>
        </div>

        <!-- Form -->
        <form method="POST" class="mt-6 space-y-4">

          <!-- Date -->
          <div>
            <label class="block text-sm mb-1 text-slate-300">Date</label>
            <input type="date" name="date" required
              class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
          </div>

          <!-- Heures -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1 text-slate-300">Heure début</label>
              <input type="time" name="heure_debut" required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>

            <div>
              <label class="block text-sm mb-1 text-slate-300">Heure fin</label>
              <input type="time" name="heure_fin" required
                class="w-full px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>
          </div>

          <!-- Footer Buttons -->
          <div class="pt-2 flex flex-col sm:flex-row gap-3 sm:justify-end">
            <button type="button" id="cancelModal"
              class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-sm">
              Annuler
            </button>

            <button type="submit" name="add_dispo"
              class="px-4 py-2 rounded-xl bg-indigo-500 text-slate-950 font-medium hover:bg-indigo-400 text-sm">
              Enregistrer
            </button>
          </div>

        </form>
      </div>
    </div>


  </main>

  <script>
    const openModalBtn = document.getElementById('openModal');
    const backdrop = document.getElementById('modalBackdrop');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelModal');

    function openModal() {
      backdrop.classList.remove('hidden');
      backdrop.classList.add('flex');
    }

    function closeModal() {
      backdrop.classList.add('hidden');
      backdrop.classList.remove('flex');
    }

    openModalBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // click outside modal to close
    backdrop.addEventListener('click', (e) => {
      if (e.target === backdrop) closeModal();
    });

    // ESC to close
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
  </script>

</body>

</html>