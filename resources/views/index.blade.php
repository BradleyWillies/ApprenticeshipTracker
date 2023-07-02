<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Apprenticeship Tracker</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

      html {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }
    </style>
  </head>

  <body class="leading-normal tracking-normal text-indigo-400 m-6 bg-cover bg-fixed" style="background-image: url('{{ asset('images/background.png') }}');">
    <div class="h-full">
      <!--Nav-->
      <div class="w-full container mx-auto">

      </div>

      <!--Main-->
      <div class="container pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex space-x-8 w-full justify-center lg:items-start overflow-y-hidden">
            <div>
                <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
                    Apprenticeship Tracker
                </h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
                    Keep track of progress throughout your degree while providing sight to your managers!
                </p>
                @if (Route::has('login'))
                    <div class="text-white text-xl py-4 sm:block ">
                        @auth
                            <a href="{{ Auth::user()->apprentice ? route('apprentice_dashboard') : route('manager_dashboard') }}" class="bg-purple-500 px-4 py-1 hover:bg-purple-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-purple-500 px-4 py-1 hover:bg-purple-600">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 bg-purple-500 px-4 py-1 hover:bg-purple-600">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
          <img src="{{ asset('images/apprentice-dashboard.png') }}" alt="Apprentice Dashboard" class="rounded w-1/2" >
        </div>
      </div>
    </div>
  </body>
</html>
