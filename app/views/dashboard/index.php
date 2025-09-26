<?php require_once APPROOT . '/views/includes/header.php'; ?>

<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
     header("Location: /homepages/index");
    exit();
}
?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-8">
            <!-- Titel van de pagina -->
            <h3>
                <?= $data['title']; ?>
            </h3>
        </div>
        <div class="col-2">
            <form method="post">
                <button type="submit" name="logout" class="btn btn-danger">Home</button>
            </form>
        </div>
        <div class="col-1"></div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="links-grid col-10">
            <a href="<?= URLROOT; ?>/ticket/index" class="nav-link px-2 text-white link-card">Ticket</a>
            <a href="<?= URLROOT; ?>/Verkopers/index" class="nav-link px-2 text-white link-card">Verkopers</a>
            <a href="<?= URLROOT; ?>/Event/index" class="nav-link px-2 text-white link-card">Events</a>
            <a href="<?= URLROOT; ?>/ContactPersoon/index" class="nav-link px-2 text-white link-card">Contactpersonen</a>
            <a href="<?= URLROOT; ?>/stands/index" class="nav-link px-2 text-white link-card">stands</a>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<?php require_once APPROOT . '/views/includes/footer.php'; ?>