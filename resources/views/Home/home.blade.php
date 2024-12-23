<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TerangaImmo - Cherche la maison de tes reve</title>
  <title>@yield('title', 'My app')</title>
  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./asset/assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link href="./asset/css/styleR.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- 
    - #HEADER
  -->
  @include('layout.header')
  
 
  <!-- Contenu principal -->
  <div class="container">
      @yield('content')
      @include('layout.body')
  </div>

  <!-- Footer -->
  @include('layout.footer')
  <!-- 
    - #FOOTER
  -->
  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>

</body>

</html>