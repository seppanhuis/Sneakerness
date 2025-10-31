<?php require_once APPROOT . '/views/includes/header.php'; ?>

<?php
// Helperfunctie voor veilige weergave van velden
function show($value, $default = 'Niet Gehuurd') {
    return htmlspecialchars($value ?? $default);
}
?>

<div class="container extra mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= htmlspecialchars($data['title'] ?? 'Overzicht Stands'); ?></h3>
            <a href="<?= URLROOT; ?>/Stands/create/" class="btn btn-primary btn-sm">Nieuwe Stand</a>
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
                        <th>Verhuren</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['Stand'])) : ?>
                        <tr>
                            <td colspan="9" class="text-center fw-bold">Geen stands gevonden</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['Stand'] as $stand) : ?>
                            <tr class="<?= isset($stand->VerhuurdStatus) && $stand->VerhuurdStatus ? 'table-secondary' : ''; ?>">
                                <td><?= show($stand->Naam); ?></td>
                                <td><?= isset($stand->SpecialeStatus) ? ($stand->SpecialeStatus ? 'Ja' : 'Nee') : 'Nee'; ?></td>
                                <td><?= show($stand->VerkooptSoort); ?></td>
                                <td><?= show($stand->VerkoperStandType); ?></td>
                                <td><?= show($stand->Dagen); ?></td>
                                <td><?= show($stand->StandStandType); ?></td>
                                <td>
                                    &euro;<?= isset($stand->Prijs) ? number_format((float)$stand->Prijs, 2, ',', '.') : '—'; ?>
                                </td>
                                <td><?= isset($stand->VerhuurdStatus) ? ($stand->VerhuurdStatus ? 'Ja' : 'Nee') : 'Nee'; ?></td>
                                <td>
                                    <?php if (!isset($stand->VerhuurdStatus) || !$stand->VerhuurdStatus) : ?>
                                        <a href="<?= URLROOT; ?>/Stands/verhuur/<?= $stand->StandId ?? ''; ?>" class="btn btn-success btn-sm">Verhuren</a>
                                    <?php else : ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Verhuurd</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
