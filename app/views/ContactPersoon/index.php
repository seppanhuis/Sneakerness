<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <!-- Titel van de pagina -->
            <h3><?= $data['title']; ?></h3>
            <a href="<?= URLROOT; ?>/ContactPersoon/create/" type="button" class="btn btn-primary btn-sm" role="button">Nieuwe ContactPersoon</a>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

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
                        <th>Naam</th>
                        <th>Speciale Status</th>
                        <th>Verkooper Naam</th>
                        <th>Stand Type</th>
                        <th>Dagen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['ContactPersonen'] as $contactpersoon): ?>
                        <tr>
                            <td><?= htmlspecialchars($contactpersoon->Naam); ?></td>
                            <td><?= $contactpersoon->SpecialeStatus ? 'Ja' : 'Nee'; ?></td>
                            <td><?= htmlspecialchars($contactpersoon->VerkooptSoort); ?></td>
                            <td><?= htmlspecialchars($contactpersoon->StandType); ?></td>
                            <td><?= htmlspecialchars($contactpersoon->Dagen); ?></td>
                            <td>
                                <a href="<?= URLROOT; ?>/ContactPersoon/assign/<?= $contactpersoon->Id; ?>" class="btn btn-sm btn-success">
                                    Contactpersoon koppelen
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
        <div class="col-1"></div>
    </div>
    <!-- einde tabel tickets -->


    <script>

    </script>

    <?php require_once APPROOT . '/views/includes/footer.php'; ?>