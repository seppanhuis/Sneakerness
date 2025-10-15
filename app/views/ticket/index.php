<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <h3><?= $data['title']; ?>
        <!-- <a href="<?= URLROOT; ?>/ticket/create">
            <i class="bi bi-plus-circle-fill text-danger"></i>
        </a> -->
    </h3>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Bezoeker</th>
                <th>Evenement</th>
                <th>Tijdslot</th>
                <th>Tarief</th>
                <th>Aantal</th>
                <th>Datum</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['tickets'])): ?>
                <tr><td colspan="7" class="text-center">Geen tickets gevonden</td></tr>
            <?php else: ?>
                <?php foreach ($data['tickets'] as $ticket): ?>
                    <tr>
                        <td><?= $ticket->BezoekerNaam; ?></td>
                        <td><?= $ticket->EvenementNaam; ?></td>
                        <td><?= $ticket->Tijdslot; ?></td>
                        <td>€ <?= number_format($ticket->Tarief, 2, ',', '.'); ?></td>
                        <td><?= $ticket->AantalTickets; ?></td>
                        <td><?= $ticket->Datum; ?></td>
                        <td>
                            <a href="<?= URLROOT; ?>/ticket/update/<?= $ticket->Id; ?>" class="btn btn-sm btn-warning">Bewerk</a>
                            <a href="<?= URLROOT; ?>/ticket/delete/<?= $ticket->Id; ?>" class="btn btn-sm btn-danger">Verwijder</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
