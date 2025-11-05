<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">

    <div class="row mb-3">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= htmlspecialchars($data['title']); ?></h3>

            <a href="<?= URLROOT; ?>/ContactPersoon/create/" 
               class="btn btn-primary btn-sm mb-3">
                Nieuwe ContactPersoon
            </a>

            <!-- Success melding -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <!-- Error melding -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- begin tabel contactpersonen -->
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10" style="overflow-x:auto;">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Naam</th>
                        <th>Telefoonnummer</th>
                        <th>Emailadres</th>
                        <th>Speciale Status</th>
                        <th>Verkoper Naam</th>
                        <th>Koppelingen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['ContactPersonen'])): ?>
                        <?php foreach ($data['ContactPersonen'] as $contactpersoon): ?>
                            <tr>
                                <td><?= htmlspecialchars($contactpersoon->Naam); ?></td>
                                <td><?= htmlspecialchars($contactpersoon->Telefoonnummer); ?></td>
                                <td><?= htmlspecialchars($contactpersoon->Emailadres); ?></td>
                                <td>
                                    <?= isset($contactpersoon->SpecialeStatus) ? ($contactpersoon->SpecialeStatus ? 'Ja' : 'Nee') : 'Nee'; ?>
                                </td>
                                <td><?= htmlspecialchars($contactpersoon->VerkoperNaam ?? '-'); ?></td>
                                <td><?= (int)$contactpersoon->Koppelingen; ?></td>
                                <td>
                                    <a href="<?= URLROOT; ?>/ContactPersoon/assign/<?= $contactpersoon->Id; ?>" 
                                       class="btn btn-sm btn-success">
                                        Koppelen
                                    </a>

                                    <?php if ((int)$contactpersoon->Koppelingen === 0): ?>
                                        <a href="<?= URLROOT; ?>/ContactPersoon/delete/<?= $contactpersoon->Id; ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Weet je zeker dat je deze contactpersoon wilt verwijderen?');">
                                            Verwijderen
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary" disabled title="Kan niet verwijderen — gekoppeld aan verkoper">
                                            Verwijderen
                                        </button>
                                    <?php endif; ?>
                                    
                                    <a href="<?= URLROOT; ?>/ContactPersoon/update/<?= $contactpersoon->Id; ?>" class="btn btn-sm btn-warning">
                                        Bewerken
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Geen contactpersonen gevonden.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>
    <!-- einde tabel -->

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
