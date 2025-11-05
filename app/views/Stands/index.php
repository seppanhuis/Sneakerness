<?php require_once APPROOT . '/views/includes/header.php'; ?>

<?php
// Helperfunctie voor veilige weergave van velden
function show($value, $default = 'Niet Gehuurd')
{
    return htmlspecialchars($value ?? $default);
}
?>

<div class="container extra mt-3">

    <!-- Flash message via $data -->
    <?php if (!empty($data['message'])): ?>
        <div class="alert <?= !empty($data['error']) ? 'alert-danger' : 'alert-success'; ?>">
            <?= htmlspecialchars($data['message']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= htmlspecialchars($data['title'] ?? 'Overzicht Stands'); ?></h3>
            <a href="<?= URLROOT; ?>/Stands/create/" class="btn btn-primary btn-sm">Nieuwe Stand</a>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- Tabel met stand- en verkopergegevens -->
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
                        <th>Acties</th>
                        <th>Verwijderen</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['Stand'])) : ?>
                        <tr>
                            <td colspan="10" class="text-center fw-bold">Geen stands gevonden</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['Stand'] as $stand) : ?>
                            <?php
                            $isVerhuurd = isset($stand->VerhuurdStatus) && (int)$stand->VerhuurdStatus === 1;
                            ?>
                            <tr class="<?= $isVerhuurd ? 'table-secondary' : ''; ?>">
                                <td><?= show($stand->Naam); ?></td>
                                <td><?= isset($stand->SpecialeStatus) ? ($stand->SpecialeStatus ? 'Ja' : 'Nee') : 'Nee'; ?></td>
                                <td><?= show($stand->VerkooptSoort); ?></td>
                                <td><?= show($stand->VerkoperStandType); ?></td>
                                <td><?= show($stand->Dagen); ?></td>
                                <td><?= show($stand->StandStandType); ?></td>
                                <td>
                                    &euro;<?= isset($stand->Prijs) ? number_format((float)$stand->Prijs, 2, ',', '.') : '—'; ?>
                                </td>
                                <td><?= $isVerhuurd ? 'Ja' : 'Nee'; ?></td>
                                <td>
                                    <!-- Verhuren-knop -->
                                    <?php if (!$isVerhuurd) : ?>
                                        <a href="<?= URLROOT; ?>/Stands/verhuur/<?= $stand->Id; ?>" class="btn btn-success btn-sm">Verhuren</a>
                                    <?php else : ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Verhuurd</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$isVerhuurd) : ?>
                                        <form method="POST" action="<?= URLROOT; ?>/Stands/delete/<?= $stand->Id; ?>" 
                                              onsubmit="return confirm('Weet je zeker dat je deze stand wilt verwijderen?');">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Verhuurd</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= URLROOT; ?>/Stands/update/<?= $stand->Id; ?>" class="btn btn-warning btn-sm">Update</a>
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
