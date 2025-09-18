<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!-- Voor het centreren van de container gebruiken we het boorstrap grid -->
 <section class="banner">
  <video autoplay muted loop playsinline class="banner-video">
    <source src="<?= URLROOT; ?>/public/img/banner.mp4" type="video/mp4" />
    Je browser ondersteunt geen video-element.
  </video>
  <div class="banner-content">
    <h1>Sneakerness</h1>
    <a href="<?= URLROOT; ?>/ContactPersoon/index" class="btn btn-primary">ContactPersonen</a>
  </div>
</section>


<?php require_once APPROOT . '/views/includes/footer.php'; ?>
