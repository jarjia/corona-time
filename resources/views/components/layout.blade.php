<!doctype html>

<title>Coronatime</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="{{asset('images/corona-logo.png')}}">
@vite('resources/css/app.css')
@vite('resources/js/app.js')

<body style="font-family: 'Inter', sans-serif;" class='tracking-wide h-screen sm:h-auto'>
    {{$slot}}
</body>