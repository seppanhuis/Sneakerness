    <?php require_once APPROOT . '/views/includes/header.php'; ?>

    <div class="container mt-3">
        <h3><?= $data['title']; ?></h3>

        <div class="alert alert-success" style="display:<?= $data['message']; ?>;">Ticket toegevoegd!</div>

        <form method="POST" action="<?= URLROOT; ?>/ticket/create">
            <div class="mb-3">
                <label>Bezoeker:</label>
                <select name="BezoekerId" class="form-select" required>
                    <option value="">-- Kies Bezoeker --</option>
                    <?php foreach ($data['bezoekers'] as $b): ?>
                        <option value="<?= $b->Id ?>"><?= $b->Naam ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Evenement:</label>
                <select name="EvenementId" class="form-select" required>
                    <option value="">-- Kies Evenement --</option>
                    <?php foreach ($data['evenementen'] as $e): ?>
                        <option value="<?= $e->Id ?>"><?= $e->Naam ?> (<?= $e->Datum ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Tijdslot / Tarief:</label>
                <select name="PrijsId" class="form-select" required>
                    <option value="">-- Kies Tijdslot --</option>
                    <?php foreach ($data['prijzen'] as $p): ?>
                        <option value="<?= $p->Id ?>"><?= $p->Tijdslot ?> - €<?= number_format($p->Tarief, 2, ',', '.'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Aantal tickets:</label>
                <input type="number" name="AantalTickets" min="1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Datum:</label>
                <input type="date" name="Datum" class="form-control" required min="<?= date('Y-m-d'); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Sla op</button>
        </form>
    </div>

    <?php require_once APPROOT . '/views/includes/footer.php'; ?>
