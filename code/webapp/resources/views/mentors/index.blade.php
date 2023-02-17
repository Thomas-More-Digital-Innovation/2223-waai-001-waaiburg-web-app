<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Begeleiders</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Begeleiders lijst" name="mentors.create" />
          <table class="border-collapse border border-[#f4f4f4] table-auto">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Functie</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mentors as $mentor)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->firstname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->lastname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->role }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->street . ' ' .  $mentor->houseNumber }} <br> {{ $mentor->city . ' ' . $mentor->zipcode}}  <br> {{ $mentor->phoneNumber }} </td>
                <td class="border border-[#f4f4f4] py-2 px-6">
                  <form action="{{ route('mentors.destroy', $mentor->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <a href="{{ route('mentors.edit', $mentor->id) }}" class="text-[#3c8dbc]">Bewerk</a>
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
  </main>
</body>

</html>