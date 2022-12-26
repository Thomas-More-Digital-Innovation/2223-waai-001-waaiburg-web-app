<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
  <title>Waaiburg - Clienten</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Clienten" />
          <div class="mt-5 grid grid-cols-7">
            <p>Voornaam</p>
            <p>Achternaam</p>
            <p>Afdeling&lpar;en&rpar;</p>
            <p>Begeleider&lpar;s&rpar;</p>
            <p>Geboortedatum</p>
            <p>Contactgegevens</p>
            <p>Acties</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>