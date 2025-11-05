<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h2 class="fw-bold text-primary mb-4">Event Wijzigen</h2>

        <?php if (!empty($data['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($data['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= URLROOT; ?>/Event/edit/<?= $data['event']->id; ?>" method="POST" class="row g-3">

            <div class="col-md-6">
                <label for="title" class="form-label fw-semibold">Titel</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="<?= htmlspecialchars($data['event']->title); ?>" required>
            </div>

            <div class="col-md-3">
                <label for="date" class="form-label fw-semibold">Datum</label>
                <input type="date" class="form-control" id="date" name="date"
                       value="<?= htmlspecialchars($data['event']->date); ?>" required>
            </div>

            <div class="col-md-3">
                <label for="time" class="form-label fw-semibold">Tijd</label>
                <input type="time" class="form-control" id="time" name="time"
                       value="<?= htmlspecialchars($data['event']->time); ?>" required>
            </div>

            <div class="col-12">
                <label for="location" class="form-label fw-semibold">Locatie</label>
                <input type="text" class="form-control" id="location" name="location"
                       value="<?= htmlspecialchars($data['event']->location); ?>" required>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-warning px-4">💾 Wijzigingen Opslaan</button>
                <a href="<?= URLROOT; ?>/Event/index" class="btn btn-secondary px-4">↩️ Terug</a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>
