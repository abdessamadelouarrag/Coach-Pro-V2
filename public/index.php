<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
  <title>CoachPro</title>
</head>

<body class="bg-slate-950 text-slate-100">

  <!-- Navbar -->
  <nav class="border-b border-slate-800 bg-slate-950/80 backdrop-blur">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
          <span class="text-emerald-400 font-bold">CP</span>
        </div>
        <span class="font-semibold text-lg">CoachPro</span>
      </div>

      <div class="flex gap-3">
        <a href="/pages/login.php" class="px-4 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 text-sm">
          Login
        </a>
        <a href="/pages/register.php" class="px-4 py-2 rounded-xl bg-emerald-500 text-slate-950 font-medium hover:bg-emerald-400">
          Register
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
    <div>
      <span class="inline-block mb-3 px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-400 text-xs">
        Plateforme de coaching
      </span>

      <h1 class="text-4xl lg:text-5xl font-bold leading-tight">
        Réserve ton coach.<br>
        Progresse à ton rythme.
      </h1>

      <p class="mt-6 text-slate-400 max-w-xl">
        CoachPro te permet de trouver des coachs qualifiés, consulter leurs disponibilités
        et réserver facilement tes séances dans une interface simple et moderne.
      </p>

      <div class="mt-8 flex flex-wrap gap-4">
        <a href="/pages/login.php"
           class="px-6 py-3 rounded-2xl bg-emerald-500 text-slate-950 font-semibold hover:bg-emerald-400 transition">
          Trouver un coach
        </a>
        <a href="/pages/login.php"
           class="px-6 py-3 rounded-2xl bg-slate-800 border border-slate-700 hover:bg-slate-700 transition">
          Se connecter
        </a>
      </div>
    </div>

    <!-- Hero card -->
    <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-8 space-y-6">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
          <i class="fa-solid fa-calendar-check text-emerald-400"></i>
        </div>
        <div>
          <p class="text-sm text-slate-400">Réservation rapide</p>
          <p class="font-semibold">Dates & heures disponibles</p>
        </div>
      </div>

      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
          <i class="fa-solid fa-user-tie text-emerald-400"></i>
        </div>
        <div>
          <p class="text-sm text-slate-400">Coachs certifiés</p>
          <p class="font-semibold">Par spécialité</p>
        </div>
      </div>

      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
          <i class="fa-solid fa-chart-line text-emerald-400"></i>
        </div>
        <div>
          <p class="text-sm text-slate-400">Suivi simple</p>
          <p class="font-semibold">Dashboard clair</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Steps -->
  <section class="border-t border-slate-800 bg-slate-950">
    <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <span class="text-emerald-400 text-sm font-semibold">01</span>
        <h3 class="mt-2 text-lg font-semibold">Choisis un coach</h3>
        <p class="mt-2 text-sm text-slate-400">Par discipline et disponibilité.</p>
      </div>

      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <span class="text-emerald-400 text-sm font-semibold">02</span>
        <h3 class="mt-2 text-lg font-semibold">Réserve ta séance</h3>
        <p class="mt-2 text-sm text-slate-400">En quelques clics seulement.</p>
      </div>

      <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
        <span class="text-emerald-400 text-sm font-semibold">03</span>
        <h3 class="mt-2 text-lg font-semibold">Suis ton progrès</h3>
        <p class="mt-2 text-sm text-slate-400">Historique & statut des réservations.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
      <p class="text-sm text-slate-400">
        © 2025 <span class="text-slate-200 font-medium">CoachPro</span>. Tous droits réservés.
      </p>
      <div class="flex gap-4 text-slate-400">
        <a href="#" class="hover:text-emerald-400"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" class="hover:text-emerald-400"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="hover:text-emerald-400"><i class="fa-brands fa-x-twitter"></i></a>
      </div>
    </div>
  </footer>

</body>
</html>
