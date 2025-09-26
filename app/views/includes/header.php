<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sneakerness</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/style.css">
  <link rel="shortcut icon" href="<?= URLROOT; ?>/public/img/icon.png" type="image/x-icon">
</head>

<body>
  <header class="p-3 text-bg-dark">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <a href="/" class="navbar-brand d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img class="logo" src="<?= URLROOT; ?>/public/img/icon.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="<?= URLROOT; ?>/homepages/index" class="nav-link">Home</a></li>
          </ul>
          <div class="d-flex">
            <a href="<?= URLROOT; ?>/dashboard/start" class="btn btn-outline-light me-2">Dashboard</a>
          </div>
        </div>
      </nav>
    </div>
  </header>