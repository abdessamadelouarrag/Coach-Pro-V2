<?php
session_start();

require_once "../config/database.php";
require_once "../classes/utilisateur.php";

$nomusre = $_SESSION['nom'];
$roleuser = $_SESSION['role'];
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
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
          name, prêt pour ta prochaine séance ?
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
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Séances à venir</p>
          <p class="text-3xl font-semibold mt-2">3</p>
          <p class="text-xs text-slate-500 mt-1">Exemple (remplace par DB)</p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Coach favoris</p>
          <p class="text-3xl font-semibold mt-2">2</p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Objectif semaine</p>
          <p class="text-3xl font-semibold mt-2">70%</p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
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
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-slate-800/70">
                <td class="py-3">Yassine M.</td>
                <td class="py-3">Musculation</td>
                <td class="py-3">2025-12-26</td>
                <td class="py-3">18:00</td>
                <td class="py-3"><span class="px-2 py-1 rounded-lg bg-emerald-500/15 text-emerald-300 border border-emerald-500/20">Confirmée</span></td>
              </tr>
              <tr class="border-b border-slate-800/70">
                <td class="py-3">Salma A.</td>
                <td class="py-3">Boxe</td>
                <td class="py-3">2025-12-28</td>
                <td class="py-3">20:00</td>
                <td class="py-3"><span class="px-2 py-1 rounded-lg bg-amber-500/15 text-amber-300 border border-amber-500/20">En attente</span></td>
              </tr>
              <tr>
                <td class="py-3">Hamza K.</td>
                <td class="py-3">Cardio</td>
                <td class="py-3">2026-01-02</td>
                <td class="py-3">10:00</td>
                <td class="py-3"><span class="px-2 py-1 rounded-lg bg-slate-800 text-slate-200 border border-slate-700">Planifiée</span></td>
              </tr>
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
          <div class="h-12 w-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center">
            <span class="text-slate-200 font-semibold"></span>
          </div>
          <div>
            <p class="font-medium"></p>
            <p class="text-xs text-slate-400"></p>
          </div>
        </div>

        <div class="mt-5 grid grid-cols-2 gap-3">
          <a href="edit_profile.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-sm text-center">
            Modifier
          </a>
          <a href="settings.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-sm text-center">
            Paramètres
          </a>
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

