<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h3 class="text-success"><?= $data['title']; ?></h3>
        </div>
        <div class="col-1"></div>
    </div>


    <!-- begin tabel verkopers -->
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">SpecialeStatus</th>
                        <th scope="col">VerkooptSoort</th>
                        <th scope="col">StandType</th> 
                        <th scope="col">Dagen</th> 
                        <th scope="col">Logo</th>                       
                      

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['Verkopers'] as $Verkoper) : ?>
                        <tr>
                            <td><?= $Verkoper->Naam;  ?></td>
                            <td><?= $Verkoper->SpecialeStatus; ?></td>
                            <td><?= $Verkoper->VerkooptSoort; ?></td>
                            <td><?= $Verkoper->StandType; ?></td>
                            <td><?= $Verkoper->Dagen; ?></td>
                            <td><?= $Verkoper->Logo; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
           
        </div>
        <div class="col-1"></div>
    </div>
    <!-- einde tabel verkopers -->

<?php require_once APPROOT . '/views/includes/footer.php'; ?> 