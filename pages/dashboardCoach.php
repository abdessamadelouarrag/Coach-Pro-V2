<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
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
          name, gère tes disponibilités et tes réservations
        </h2>
        <p class="text-slate-400 mt-2">
          Ajoute tes créneaux, confirme/refuse des demandes, et suis ton planning.
        </p>

        <div class="mt-5 flex flex-wrap gap-3">
          <a href="disponibilite_add.php" class="px-4 py-2 rounded-xl bg-indigo-500 text-slate-950 font-medium hover:bg-indigo-400">
            + Ajouter une disponibilité
          </a>
          <a href="coach_reservations.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700">
            Voir les réservations
          </a>
        </div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Demandes</p>
          <p class="text-3xl font-semibold mt-2">5</p>
          <p class="text-xs text-slate-500 mt-1">Exemple</p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-5">
          <p class="text-sm text-slate-400">Séances confirmées</p>
          <p class="text-3xl font-semibold mt-2">8</p>
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
          <h3 class="text-lg font-semibold">Planning (prochains créneaux)</h3>
          <a class="text-sm text-indigo-300 hover:underline" href="disponibilites.php">Gérer</a>
        </div>

        <div class="mt-4 space-y-3">
          <div class="p-4 rounded-2xl border border-slate-800 bg-slate-950/30 flex items-center justify-between">
            <div>
              <p class="font-medium">2025-12-26</p>
              <p class="text-sm text-slate-400">18:00 → 19:00</p>
            </div>
            <span class="px-2 py-1 rounded-lg bg-emerald-500/15 text-emerald-300 border border-emerald-500/20 text-xs">Libre</span>
          </div>

          <div class="p-4 rounded-2xl border border-slate-800 bg-slate-950/30 flex items-center justify-between">
            <div>
              <p class="font-medium">2025-12-28</p>
              <p class="text-sm text-slate-400">20:00 → 21:00</p>
            </div>
            <span class="px-2 py-1 rounded-lg bg-amber-500/15 text-amber-300 border border-amber-500/20 text-xs">Demandée</span>
          </div>

          <div class="p-4 rounded-2xl border border-slate-800 bg-slate-950/30 flex items-center justify-between">
            <div>
              <p class="font-medium">2026-01-02</p>
              <p class="text-sm text-slate-400">10:00 → 11:00</p>
            </div>
            <span class="px-2 py-1 rounded-lg bg-slate-800 text-slate-200 border border-slate-700 text-xs">Planifiée</span>
          </div>
        </div>
      </div>

    </section>

    <!-- Right -->
    <aside class="lg:col-span-4 space-y-6">

      <!-- Profile -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Mon profil coach</h3>

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
          <a href="coach_settings.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-sm text-center">
            Paramètres
          </a>
        </div>
      </div>

      <!-- Quick actions -->
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <h3 class="text-lg font-semibold">Actions rapides</h3>
        <div class="mt-4 grid gap-3">
          <a href="disponibilite_add.php" class="px-4 py-2 rounded-xl bg-indigo-500 text-slate-950 font-medium hover:bg-indigo-400 text-center">
            Ajouter disponibilité
          </a>
          <a href="coach_reservations.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-center">
            Gérer réservations
          </a>
          <a href="coach_clients.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-center">
            Mes sportifs
          </a>
        </div>
      </div>

    </aside>
  </main>

</body>
</html>
