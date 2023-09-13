<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <span class="h1 text-center float-left"><b>Information du personnel N°</b><?= $personne->id_personne; ?></span>
                    <a href="<?php echo base_url('personne'); ?>" class="btn btn-danger float-right"> Retour </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>Nom complet</th>
                                <td><?= $personne->prenom ?>&nbsp; <?= $personne->nom ?></td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                <td><?= $personne->tel ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href><?= $personne->email ?></a></td>
                            </tr>
                            <tr>
                                <th>Fonction exercer</th>
                                <td><?= $personne->fonction ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>