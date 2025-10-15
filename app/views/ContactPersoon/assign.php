<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <h3><?= htmlspecialchars($data['title']); ?></h3>

    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($data['error']); ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="VerkoperId" class="form-label">Kies een Verkoper</label>
            <select name="VerkoperId" id="VerkoperId" class="form-select" required>
                <option value="" disabled selected>-- Selecteer verkoper --</option>
                <?php foreach ($data['Verkopers'] as $verkoper): ?>
                    <option value="<?= $verkoper->Id ?>" 
                        <?= isset($data['ContactPersoon']) && $verkoper->Id == $data['ContactPersoon']->VerkoperId ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($verkoper->Naam) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if (!$data['ContactPersoon']): ?>
        <div class="mb-3">
            <label for="ContactpersoonId" class="form-label">Kies een Contactpersoon</label>
            <select name="ContactpersoonId" id="ContactpersoonId" class="form-select" required>
                <option value="" disabled selected>-- Selecteer contactpersoon --</option>
                <?php foreach ($data['ContactPersonen'] as $cp): ?>
                    <option value="<?= $cp->Id ?>"><?= htmlspecialchars($cp->Naam) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary btn-sm">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
