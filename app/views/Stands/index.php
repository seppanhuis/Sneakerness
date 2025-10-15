<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= $data['title']; ?></h3>
            <a href="<?= URLROOT; ?>/Stands/create/" type="button" class="btn btn-primary btn-sm" role="button">Nieuwe Stand</a>
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
                                <td><?= htmlspecialchars($stand->Naam ?? 'Niet Gehuurd'); ?></td>
                                <td><?= isset($stand->SpecialeStatus) ? ($stand->SpecialeStatus ? 'Ja' : 'Nee') : 'nee'; ?></td>
                                <td><?= htmlspecialchars($stand->VerkooptSoort ?? 'Niet Gehuurd'); ?></td>
                                <td><?= htmlspecialchars($stand->VerkoperStandType ?? 'Niet Gehuurd'); ?></td>
                                <td><?= htmlspecialchars($stand->Dagen ?? 'Niet Gehuurd'); ?></td>
                                <td><?= htmlspecialchars($stand->StandStandType ?? 'Niet Gehuurd'); ?></td>
                                <td>
                                    &euro;<?= isset($stand->Prijs) ? number_format((float)$stand->Prijs, 2, ',', '.') : '—'; ?>
                                </td>
                                <td><?= isset($stand->VerhuurdStatus) ? ($stand->VerhuurdStatus ? 'Ja' : 'Nee') : 'Nee'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>

    <?php require_once APPROOT . '/views/includes/footer.php'; ?>