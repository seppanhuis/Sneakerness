<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Evenementen Overzicht</h1>
        <a href="<?= URLROOT; ?>/Event/add" class="btn btn-success">➕ Nieuw Event Toevoegen</a>
    </div>

    <!-- ✅ Bootstrap Alert voor meldingen -->
    <?php if (!empty($data['message'])): ?>
        <div id="flashMessage" 
             class="alert alert-<?= htmlspecialchars($data['message_type']); ?> alert-dismissible fade show shadow-sm rounded-3" 
             role="alert">
            <strong><?= htmlspecialchars($data['message']); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            // Laat de melding automatisch verdwijnen na 3 seconden
            setTimeout(() => {
                const alert = document.getElementById('flashMessage');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    <?php endif; ?>

    <?php if (!empty($data['events'])): ?>
        <div class="row">
            <?php foreach ($data['events'] as $event): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-dark fw-semibold mb-2">
                                <?= htmlspecialchars($event->title); ?>
                            </h5>
                            <p class="card-text text-muted mb-1">
                                📅 <?= date('d M Y', strtotime($event->date)); ?>
                            </p>
                            <p class="card-text text-muted mb-1">
                                🕒 <?= substr($event->time, 0, 5); ?>
                            </p>
                            <p class="card-text text-muted mb-3">
                                📍 <?= htmlspecialchars($event->location); ?>
                            </p>

                            <div class="d-flex justify-content-between">
                                <a href="<?= URLROOT; ?>/ticket/index" class="btn btn-outline-primary btn-sm">
                                    🎟️ Bekijk Tickets
                                </a>
                                <a href="<?= URLROOT; ?>/Event/edit/<?= $event->id; ?>" class="btn btn-warning btn-sm">
                                    ✏️ Wijzig
                                </a>
                                <form action="<?= URLROOT; ?>/Event/delete/<?= $event->id; ?>" method="POST" 
      onsubmit="return confirm('Weet je zeker dat je verder wilt gaan?');" style="display:inline;">
    <button type="submit" class="btn btn-danger btn-sm">🗑️ Verwijder</button>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4">
            ⚠️ Geen events gevonden.
        </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>
