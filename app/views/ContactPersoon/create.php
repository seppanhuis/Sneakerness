<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3><?= $data['title']; ?></h3>
        </div>
        <div class="col-3"></div>
    </div>

    


   
    <div class="row">
        <div class="col-3"></div>
                        <div class="col-6">
                                <?php if (!empty($data['error'])): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $data['error']; ?>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= URLROOT;?>/ContactPersoon/create" method="post">
                    <div class="mb-3">
                        <label for="Naam" class="form-label">Naam</label>
                        <input name="Naam" type="text" class="form-control" id="Naam" placeholder="" required>
                    </div>

                    <div class="mb-3">
                        <label for="Emailadres" class="form-label">Email</label>
                        <input name="Emailadres" type="text" class="form-control" id="Emailadres" placeholder="" required>
                    </div>

                    <div class="mb-3">
                        <label for="Telefoonnummer" class="form-label">Telefoonnummer</label>
                        <input name="Telefoonnummer" type="number" class="form-control" id="Telefoonnummer" placeholder="" required>
                    </div>


                    <button class="btn btn-primary btn-sm" type="submit">Verstuur</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
            
                            
            <a href="<?= URLROOT; ?>">Terug</a> 

<?php require_once APPROOT . '/views/includes/footer.php'; ?> 