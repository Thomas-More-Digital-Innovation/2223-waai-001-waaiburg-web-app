<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Nieuwtjes</title>
  <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <h1 class="text-2xl">Nieuwtje toevoegen</h1>
          <form action="{{ route('news.store') }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('POST')

            <x-form-input name="title" text="Titel" />
            <x-form-input name="shorttext" text="Korte inhoud" />

            <label for="content" class="font-bold">Inhoud*</label>
            <textarea class="ckeditor form-control" name="content" id="content"></textarea>

            <x-form-button text="Aanmaken" />
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>