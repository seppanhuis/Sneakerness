<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <h3><?= $data['title']; ?></h3>

    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($data['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= URLROOT; ?>/ContactPersoon/update/<?= $data['ContactPersoon']->Id; ?>">
        <div class="mb-3">
            <label for="Naam" class="form-label">Naam:</label>
            <input type="text" id="Naam" name="Naam" class="form-control" value="<?= htmlspecialchars($data['ContactPersoon']->Naam); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Telefoonnummer" class="form-label">Telefoonnummer:</label>
            <input type="text" id="Telefoonnummer" name="Telefoonnummer" class="form-control" value="<?= htmlspecialchars($data['ContactPersoon']->Telefoonnummer); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Emailadres" class="form-label">Emailadres:</label>
            <input type="email" id="Emailadres" name="Emailadres" class="form-control" value="<?= htmlspecialchars($data['ContactPersoon']->Emailadres); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Opmerking" class="form-label">Opmerking:</label>
            <input type="text" id="Opmerking" name="Opmerking" class="form-control" value="<?= htmlspecialchars($data['ContactPersoon']->Opmerking ?? ''); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Bijwerken</button>
        <a href="<?= URLROOT; ?>/ContactPersoon/index" class="btn btn-secondary ms-2">Annuleren</a>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
