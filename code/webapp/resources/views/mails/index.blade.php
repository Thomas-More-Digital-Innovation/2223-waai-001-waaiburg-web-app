<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Mails</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Mails" name="" />
          <table class="border-collapse border border-[#f4f4f4] w-full">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6 text-left">Onderwerp</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mails as $mail)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6 w-full">{{ $mail->title }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6 w-full">         
                  <a href="{{ route('mails.edit', $mail->id) }}" class="text-[#3c8dbc]">Bewerk</a>      
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