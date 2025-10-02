<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <!-- Titel van de pagina -->
            <h3><?= $data['title']; ?></h3>            
            <a href="<?= URLROOT; ?>/ContactPersoon/create/" type="button" class="btn btn-primary btn-sm" role="button">Nieuwe ContactPersoon</a>
        </div>
        <div class="col-1"></div>
    </div>

   

    <!-- begin tabel tickets -->
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10" style="overflow-x:auto;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Telefoon nummer</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['ContactPersonen'])) : ?>
                        <tr>
                            <td colspan="7" class="text-center fw-bold">Geen contactpersonen gevonden</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['ContactPersonen'] as $contactpersoon) : ?>
                            <tr>
                                <td><?= $contactpersoon->Naam; ?></td>
                                <td><?= $contactpersoon->Telefoonnummer; ?></td>
                                <td><?= $contactpersoon->Emailadres; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                </tbody>
            </table>
            
        </div>
        <div class="col-1"></div>
    </div>
    <!-- einde tabel tickets -->


    <script>
        
    </script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>