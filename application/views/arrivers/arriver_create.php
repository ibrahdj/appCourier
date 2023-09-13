<style>
    .file {
    position: relative;
    overflow: hidden;
    }
    .file input {
    position: absolute;
    font-size: 50px;
    opacity: 0;
    right: 0;
    top: 0;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <span class="h1"><b>Ajouter un courrier arrivé</b></span>                    
                <a href="<?php echo base_url('arriver'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('arriver/add'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date d'arriver</label>
                                <input type="Date" name="date_arriv" class="form-control">
                                <?php if(form_error('date_arriv')): ?>
                                <div class="alert-danger"><?php echo form_error('date_arriv'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">N° d'arriver</label>
                                <input type="text" name="num_arriv"  class="form-control">
                                <?php if(form_error('num_arriv')): ?>
                                <div class="alert-danger"><?php echo form_error('num_arriv'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date correspondance </label>
                                <input type="Date" name="date_corresp" class="form-control">
                                <?php if(form_error('date_corresp')): ?>
                                <div class="alert-danger"><?php echo form_error('date_corresp'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">N° correspondance </label>
                                <input type="text" name="num_corresp" class="form-control">
                                <?php if(form_error('num_corresp')): ?>
                                <div class="alert-danger"><?php echo form_error('num_corresp'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Expéditeur</label>
                                <input type="text" name="expediteur" class="form-control">
                                <?php if(form_error('expediteur')): ?>
                                <div class="alert-danger"><?php echo form_error('expediteur'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Objet</label>
                                <input type="text" name="objet" class="form-control">
                                <?php if(form_error('objet')): ?>
                                <div class="alert-danger"><?php echo form_error('objet'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date réponse </label>
                                <input type="Date" name="date_reponse" class="form-control">
                                <?php if(form_error('date_reponse')): ?>
                                <div class="alert-danger"><?php echo form_error('date_reponse'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">N° réponse </label>
                                <input type="text" name="num_reponse" class="form-control">
                                <?php if(form_error('num_reponse')): ?>
                                <div class="alert-danger"><?php echo form_error('num_reponse'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group file btn btn-info mb-3">
                        La pièce jointe &nbsp;
                        <i class="fas fa-upload"></i>
                        <input type="file" accept=".xls,.xlsx,.pdf,.png,.jpeg" name="piece_jointe"  />
                    </div>
                    <input type="hidden" name="created_at" value="<?= date('Y/m/d')?>">
                    <div class="form-group">
                        <button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button>
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>