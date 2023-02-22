<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Nieuwtjes</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

      <div class="flex flex-row">
        <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
          <div class="border-t-4 rounded border-[#3c8dbc]">
            <div class="m-3">
                <h1 class="text-2xl">Volwassen wijzigen</h1>
                <form action="{{ route('adults.update', $adult->id) }}" method="POST" class="flex flex-col mt-3">
                    @csrf
                    @method('PATCH')
        
                    <label for="title" class="font-bold">Titel*</label>
                    <input type="text" name="title" id="title" placeholder="Enter titel" required class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]" value={{ $adult->title }}>
        
                    <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Wijzigen</button>
                </form>
            </div>
          </div>
        </div>
        <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
          <div class="border-t-4 rounded border-[#3c8dbc]">
            <div class="m-3">
              <x-list-title title="Info Segmenten voor volwassenen" name="adults.create" />
              <table class="border-collapse border border-[#f4f4f4] table-auto">
                <thead>
                  <tr>
                    <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                    <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($infoContents as $infoContent)
                  <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $infoContent->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                      <form action="{{ route('adults.destroy', $infoContent->id) }}" method="post">
                        @csrf
                        @method('delete')
    
                        <a href="{{ route('adults.edit', $infoContent->id) }}" class="text-[#3c8dbc]">Bewerk</a>
                        <span>|</span>
    
                        <button type="submit" class="text-[#3c8dbc]">Verwijder</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </main>
</body>

</html>