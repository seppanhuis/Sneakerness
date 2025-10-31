<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">
    <h3><?= $data['title']; ?></h3>

    <div class="alert alert-success" style="display:<?= $data['message']; ?>;">Ticket aangepast!</div>
    <?php if (!empty($data['error'])): ?>
        <div id="serverError" class="alert alert-danger"><?= $data['error']; ?></div>
    <?php else: ?>
        <div id="serverError" class="alert alert-danger" style="display:none"></div>
    <?php endif; ?>

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
            <select id="evenementSelect" name="EvenementId" class="form-select" required>
                <?php foreach ($data['evenementen'] as $e): ?>
                    <option value="<?= $e->Id ?>" data-datum="<?= $e->Datum ?>" <?= $e->Id == $data['ticket']->EvenementId ? 'selected' : '' ?>><?= $e->Naam ?> (<?= $e->Datum ?>)</option>
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
            <input id="datumInput" type="date" name="Datum" value="<?= $data['ticket']->Datum ?>" class="form-control" required>
            <div id="clientError" class="text-danger mt-1" style="display:none">De geselecteerde datum komt niet overeen met de datum van het gekozen evenement.</div>
        </div>

















        
        <script>
            (function(){
                const form = document.querySelector('form');
                const select = document.getElementById('evenementSelect');
                const datumInput = document.getElementById('datumInput');
                const clientError = document.getElementById('clientError');
                const serverError = document.getElementById('serverError');

                function normalizeDateForCompare(value) {
                    if (!value) return null;
                    // value expected in YYYY-MM-DD from input[type=date]
                    // If value contains time or other format, try to parse
                    const d = new Date(value);
                    if (isNaN(d.getTime())) return null;
                    const yyyy = d.getFullYear();
                    const mm = String(d.getMonth()+1).padStart(2,'0');
                    const dd = String(d.getDate()).padStart(2,'0');
                    return `${yyyy}-${mm}-${dd}`;
                }

                form.addEventListener('submit', function(e){
                    // clear server error when attempting client-side validation
                    if (serverError) serverError.style.display = 'none';

                    const opt = select.options[select.selectedIndex];
                    const eventDatumRaw = opt ? opt.getAttribute('data-datum') : null;
                    const eventDatum = normalizeDateForCompare(eventDatumRaw);
                    const submittedDatum = normalizeDateForCompare(datumInput.value);

                    if (eventDatum === null || submittedDatum === null) {
                        // if either date can't be parsed, allow submit and let server validate
                        clientError.style.display = 'none';
                        return;
                    }

                    if (eventDatum !== submittedDatum) {
                        e.preventDefault();
                        clientError.style.display = 'block';
                        return false;
                    }

                    // dates match, allow submit
                    clientError.style.display = 'none';
                });
            })();
        </script>

        <button type="submit" class="btn btn-warning">Wijzig ticket</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
