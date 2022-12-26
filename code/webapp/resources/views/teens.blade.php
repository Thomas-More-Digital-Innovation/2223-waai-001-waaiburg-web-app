<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Jongeren</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Info Segmenten voor jongeren" />
          <div class="mt-5 grid grid-cols-3">
            <p>Titel</p>
            <p>Infoblokken</p>
            <p>Acties</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>