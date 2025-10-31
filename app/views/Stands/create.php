<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3><?= htmlspecialchars($data['title']); ?></h3>
        </div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <?php if (!empty($data['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($data['error']); ?>
                </div>
            <?php endif; ?>
            <form action="<?= URLROOT; ?>/Stands/create" method="post">

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
                    <input
                        name="Prijs"
                        type="number"
                        step="0.01"
                        min="0"
                        max="99999999.99"
                        class="form-control"
                        id="Prijs"
                        placeholder="Bijv. 100.00"
                        value="<?= htmlspecialchars($data['Prijs'] ?? '') ?>"
                        required>
                </div>

                <button class="btn btn-primary btn-sm" type="submit">Verstuur</button>
            </form>

        </div>
        <div class="col-3"></div>
    </div>

    <a href="<?= URLROOT; ?>">Terug</a>

    <?php require_once APPROOT . '/views/includes/footer.php'; ?>