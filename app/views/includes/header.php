<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVC OOP PDO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/style.css">
  <link rel="shortcut icon" href="<?= URLROOT; ?>/public/img/icon.png" type="image/x-icon">
</head>

<body>
  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"> 
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"> <img class="logo" src="<?= URLROOT; ?>/public/img/icon.png" alt="logo"></a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="/verkopers/index" class="nav-link px-2 text-white">Verkopers</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>
        <div class="text-end"> <button type="button" class="btn btn-outline-light me-2">Login</button> <button type="button" class="btn btn-warning">Sign-up</button> </div>
      </div>
    </div>
  </header>