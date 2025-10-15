<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3><?= htmlspecialchars($data['title']); ?></h3>

            <?php if (!empty($data['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($data['error']); ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="VerkoperId" class="form-label">Kies een verkoper</label>
                    <select name="VerkoperId" id="VerkoperId" class="form-select" required>
                        <option value="" disabled selected>-- Kies een verkoper --</option>
                        <?php foreach ($data['verkopers'] as $verkoper): ?>
                            <option value="<?= $verkoper->Id ?>"><?= htmlspecialchars($verkoper->Naam) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button class="btn btn-success" type="submit">Verhuren</button>
                <a href="<?= URLROOT; ?>/Stands/index" class="btn btn-secondary">Annuleren</a>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
