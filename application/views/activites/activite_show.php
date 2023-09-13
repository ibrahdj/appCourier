
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <span class="h1 text-center float-left"><b>Information de l'activite N°</b><?= $activite->id_activite; ?></span>
                    <a href="<?php echo base_url('activite'); ?>" class="btn btn-danger float-right"> Retour </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>Lieu de l'activite</th>
                                <td><?= $activite->lieu_activite; ?></td>
                            </tr>
                            <tr>
                                <th>Heure du debut</th>
                                <td><?= $activite->heure_debut; ?></td>
                            </tr>
                            <tr>
                                <th>Heure du fin</th>
                                <td><?= $activite->heure_fin; ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?= $activite->description; ?></td>
                            </tr>
                            <tr>
                                <th>Date de l'activite</th>
                                <td><?= $activite->date_activite; ?></td>
                            </tr>
                            <tr>
                                <th>Personnel</th>
                                <td>
                                    <?php foreach($activite->part_all as $parts):?>
                                    <?php foreach ($activite->personne_all as $pers):?>
                                        <?php if($activite->id_activite == $parts->activite_id && $pers->id_personne == $parts->personne_id):?>
                                                <?= $pers->prenom ?> <?= $pers->nom; ?>&nbsp;
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>