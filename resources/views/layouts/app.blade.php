<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main id="app">
                {{ $slot }}
            </main>
        </div>
        <script>
            @if (session('success'))
                showSuccessMsg();
            @endif

            function confirmDelete(e) {
              myForm = document.getElementById('form'); // form 이란 id 를 가진 dom 객체를 가져옴.
              flag = confirm("Are You Sure?");
    
              if(flag){
                //서버에 서브밋
                myForm.submit();
              }
               //e.preventDefault(); // form이 서버로 전달되는 것을 막아준다.
            }

            function deleteImage(){
                editForm = document.getElementById('editForm');
                editForm._method.value = 'delete'; // method scopping
                editForm.action = '/posts/image/' + id;
                editForm.submit();
            return false;
            }

            function showSuccessMsg(){
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Your work has been saved.',
                    showConfrimButton: false,
                    timer: 1500
                })
            }
          </script> 
    </body>
</html>
 