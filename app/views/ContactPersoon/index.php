<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3><?= $data['title']; ?></h3>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="row mb-2">
        <div class="col-1"></div>
        <div class="col-10">
        <!-- <a href="<?= URLROOT; ?>/Zanger/create/" type="button" class="btn btn-primary btn-sm" role="button">Nieuwe Zangerres</a> -->
        </div>
        <div class="col-1"></div>
    </div>
    


   
    <!-- begin tabel smartphones -->
    <div class="row">
        <!-- <div class="col-1"></div> -->
        <div class="col-12">
            <table class="table table-striped table-hover">
               <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Telefoonnummer</th>
                        <th scope="col">Emailadres</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['ContactPersonen'] as $CP) : ?>
                        <tr>
                            <td><?= $CP->Naam; ?></td>
                            <td><?= $CP->Telefoonnummer; ?></td>
                            <td><?= $CP->Emailadres; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>      
            </table>
            <a href="<?= URLROOT; ?>">Terug</a> 
        </div>
        <!-- <div class="col-1"></div> -->
    </div>
    <!-- einde tabel smartphones -->

<?php require_once APPROOT . '/views/includes/footer.php'; ?> 