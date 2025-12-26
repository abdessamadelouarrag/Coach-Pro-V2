<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>404</title>
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center">

  <div class="text-center max-w-md px-6">

    <div class="text-7xl font-extrabold text-emerald-400 tracking-wide">
      404
    </div>

    <h1 class="mt-3 text-2xl font-semibold">
      Page introuvable
    </h1>

    <p class="mt-2 text-slate-400">
      La page que tu cherches n’existe pas ou a été déplacée.
    </p>

    <div class="mt-6 flex justify-center gap-3">
      <a href="index.php"
         class="px-5 py-2.5 rounded-xl bg-emerald-500 text-slate-950 font-medium hover:bg-emerald-400 transition">
        Retour à l’accueil
      </a>

      <a href="javascript:history.back()"
         class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 transition">
        Page précédente
      </a>
    </div>

  </div>

</body>
</html>
