<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <h3><?= $data['title']; ?></h3>

    <div class="alert alert-success" style="display:<?= $data['message']; ?>;">Ticket aangepast!</div>

    <form method="POST" action="<?= URLROOT; ?>/ticket/update/<?= $data['ticket']->Id; ?>">
        <div class="mb-3">
            <label>Bezoeker:</label>
            <select name="BezoekerId" class="form-select" required>
                <?php foreach ($data['bezoekers'] as $b): ?>
                    <option value="<?= $b->Id ?>" <?= $b->Id == $data['ticket']->BezoekerId ? 'selected' : '' ?>><?= $b->Naam ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Evenement:</label>
            <select name="EvenementId" class="form-select" required>
                <?php foreach ($data['evenementen'] as $e): ?>
                    <option value="<?= $e->Id ?>" <?= $e->Id == $data['ticket']->EvenementId ? 'selected' : '' ?>><?= $e->Naam ?> (<?= $e->Datum ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Tijdslot / Tarief:</label>
            <select name="PrijsId" class="form-select" required>
                <?php foreach ($data['prijzen'] as $p): ?>
                    <option value="<?= $p->Id ?>" <?= $p->Id == $data['ticket']->PrijsId ? 'selected' : '' ?>>
                        <?= $p->Tijdslot ?> - €<?= number_format($p->Tarief, 2, ',', '.'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Aantal tickets:</label>
            <input type="number" name="AantalTickets" min="1" value="<?= $data['ticket']->AantalTickets ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Datum:</label>
            <input type="date" name="Datum" value="<?= $data['ticket']->Datum ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Wijzig ticket</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
