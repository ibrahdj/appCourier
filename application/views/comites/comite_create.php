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
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <span class="h1"><b>Ajouter une session</b></span>                    
                <a href="<?php echo base_url('comite'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('comite/add'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ordre du jour</label>
                                <input type="text" name="agenda" class="form-control">
                                <?php if(form_error('agenda')): ?>
                                <div class="alert-danger"><?php echo form_error('agenda'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Lieu du session</label>
                                <input type="text" name="lieu_comite"  class="form-control">
                                <?php if(form_error('lieu_comite')): ?>
                                <div class="alert-danger"><?php echo form_error('lieu_comite'); ?></div>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date du session </label>
                                <input type="Date" name="date_comite" class="form-control">
                                <?php if(form_error('date_comite')): ?>
                                <div class="alert-danger"><?php echo form_error('date_comite'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <label for=""></label>
                            <div class="form-group">
                                <span class="btn btn-info  btn-file" title="Ajouter une pièce">La pièce jointe &nbsp;
                                    <i class="fas fa-upload"></i><input type="file" accept=".xls,.xlsx,.pdf,.png,.jpeg" name="piece_jointe[]" multiple/>
                                </span>
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