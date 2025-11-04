<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container extra mt-3">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= htmlspecialchars($data['title']); ?></h3>

            <?php if (!empty($data['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($data['error']); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= URLROOT; ?>/Stands/update/<?= $data['Id']; ?>">
                <div class="mb-3">
                    <label for="StandType" class="form-label">Stand Type</label>
                    <select name="StandType" id="StandType" class="form-select" required>
                        <option value="" disabled <?= empty($data['StandType']) ? 'selected' : ''; ?>>-- Kies een type --</option>
                        <option value="A" <?= ($data['StandType'] ?? '') === 'A' ? 'selected' : ''; ?>>A</option>
                        <option value="AA" <?= ($data['StandType'] ?? '') === 'AA' ? 'selected' : ''; ?>>AA</option>
                        <option value="AA+" <?= ($data['StandType'] ?? '') === 'AA+' ? 'selected' : ''; ?>>AA+</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Prijs" class="form-label">Prijs</label>
                    <input type="text" name="Prijs" id="Prijs" class="form-control" required 
                           value="<?= htmlspecialchars($data['Prijs'] ?? ''); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Opslaan</button>
                <a href="<?= URLROOT; ?>/Stands/index" class="btn btn-secondary">Annuleren</a>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
