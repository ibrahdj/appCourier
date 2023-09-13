
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">                
                <span class="h1"><b>Ajouter un personnel</b></span>
                <a href="<?php echo base_url('personne'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('personne/add'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Prénom</label>
                                <input type="text" name="prenom" class="form-control">
                                <?php if(form_error('prenom')): ?>
                                <div class="alert-danger"><?php echo form_error('prenom'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" name="nom" class="form-control">
                                <?php if(form_error('nom')): ?>
                                <div class="alert-danger"><?php echo form_error('nom'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Téléphone</label>
                                <input type="text" name="tel" class="form-control" data-inputmask='"mask": "(999) 99-99-99-99"' data-mask>
                                <?php if(form_error('tel')): ?>
                                <div class="alert-danger"><?php echo form_error('tel'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                                <?php if(form_error('email')): ?>
                                <div class="alert-danger"><?php echo form_error('email'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Fonction exercer</label>
                                <input type="text" name="fonction" class="form-control">
                                <?php if(form_error('fonction')): ?>
                                <div class="alert-danger"><?php echo form_error('fonction'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button>
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>