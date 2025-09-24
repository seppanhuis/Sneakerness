<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= $data['title']; ?></h3>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- begin tabel met stand- en verkopergegevens -->
    <div class="row mt-4">
        <div class="col-1"></div>
        <div class="col-10" style="overflow-x:auto;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Speciale Status</th>
                        <th>Verkoopt Soort</th>
                        <th>Verkoper Stand Type</th>
                        <th>Dagen</th>
                        <th>Stand Type</th>
                        <th>Prijs</th>
                        <th>Verhuurd</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['Stand'])) : ?>
                        <tr>
                            <td colspan="8" class="text-center fw-bold">Geen stands gevonden</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['Stand'] as $stand) : ?>
                            <tr>
                                <td><?= htmlspecialchars($stand->Naam); ?></td>
                                <td><?= $stand->SpecialeStatus ? 'Ja' : 'Nee'; ?></td>
                                <td><?= htmlspecialchars($stand->VerkooptSoort); ?></td>
                                <td><?= htmlspecialchars($stand->VerkoperStandType); ?></td>
                                <td><?= htmlspecialchars($stand->Dagen); ?></td>
                                <td><?= htmlspecialchars($stand->StandStandType); ?></td>
                                <td>&euro;<?= number_format($stand->Prijs, 2, ',', '.'); ?></td>
                                <td><?= $stand->VerhuurdStatus ? 'Ja' : 'Nee'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
