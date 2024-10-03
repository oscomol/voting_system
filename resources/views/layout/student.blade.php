<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Student</title>

    @vite(['resources/css/app.css'])
</head>

<body>

    @yield('content')

     @vite(['resources/js/app.js'])
     @yield('script')

     @if (session('message'))
     <script>
         Swal.fire({
             icon: "success",
             text: "{{ session('message') }}",
             timer: 3000
         });
     </script>
 @endif

 @if (session('error'))
     <script>
         Swal.fire({
             icon: "error",
             text: "{{ session('error') }}",
             timer: 3000
         });
     </script>
 @endif

</body>
</html>
