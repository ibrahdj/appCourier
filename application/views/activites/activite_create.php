<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1"><b>Ajouter une activite</b></span>
                <a href="<?php echo base_url('activite'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <?php if($this->session->flashdata('status')): ?>
                    <div class="alert alert-danger text-center">
                        <?= $this->session->flashdata('status'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url('activite/add'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="from-group">
                                <label for="lieu_activite">Lieu de l'activité</label>
                                <input type="text" name="lieu_activite" class="form-control">
                                <?php if(form_error('lieu_activite')): ?>
                                <span class="text-danger"><?php echo form_error('lieu_activite'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="from-group">
                                <label for="heure_debut">Heure du debut</label>
                                <input type="Time" name="heure_debut" class="form-control">
                                <?php if(form_error('heure_debut')): ?>
                                <span class="text-danger"><?php echo form_error('heure_debut'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="from-group">
                                <label for="heure_fin">Heure du fin</label>
                                <input type="Time" name="heure_fin" class="form-control">
                                <?php if(form_error('heure_fin')): ?>
                                <span class="text-danger"><?php echo form_error('heure_fin'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc">Description </label>
                                <textarea class="form-control" name="description" id="desc" rows="3"></textarea>
                                <?php if(form_error('description')): ?>
                                <div class="alert-danger"><?php echo form_error('description'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="from-group">
                                <label>Personnels</label>
                                <select name="personne_id[]" class="select2 form-control" multiple="multiple" data-placeholder="Selection à multiple">
                                    <option></option>
                                    <?php 
                                    foreach ($personne as $pers):?>
                                    <option value="<?= $pers->id_personne ?>"> <?= $pers->prenom?>  <?= $pers->nom?></option>
                                    <?php 
                                    endforeach;
                                    ?>                          
                                </select>
                                <?php if(form_error('personne_id')): ?>
                                <span class="text-danger"><?php echo form_error('personne_id'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="from-group">
                                <label for="lieu_activite">Date de l'activité</label>
                                <input type="Date" name="date_activite" class="form-control" placeholder="Nom complet">
                                <?php if(form_error('date_activite')): ?>
                                <span class="text-danger"><?php echo form_error('date_activite'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button> &nbsp;
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>