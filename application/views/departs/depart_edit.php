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
            <?php if($this->session->flashdata('status')): ?>
            <div class="alert alert-success text-center">
                <?= $this->session->flashdata('status'); ?>
            </div>
                <?php endif; ?>
                <h3>
                    Editer le courrier départ N° <?= $depart->id_depart ?>
                    <a href="<?php echo base_url('depart'); ?>" class="btn btn-danger float-right"> Retour </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('depart/update/'.$depart->id_depart ); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">N° d'ordre</label>
                                <input type="text" name="num_ordre" value="<?= $depart->num_ordre ?>"  class="form-control">
                                <?php if(form_error('num_ordre')): ?>
                                <div class="alert-danger"><?php echo form_error('num_ordre'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre de pièces</label>
                                <input type="text" name="nbre_piece" value="<?= $depart->nbre_piece ?>"  class="form-control">
                                <?php if(form_error('nbre_piece')): ?>
                                <div class="alert-danger"><?php echo form_error('nbre_piece'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date départ</label>
                                <input type="Date" name="date_depart" value="<?= $depart->date_depart ?>" class="form-control">
                                <?php if(form_error('date_depart')): ?>
                                <div class="alert-danger"><?php echo form_error('date_depart'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Destinataire</label>
                                <input type="text" name="destinateur" value="<?= $depart->destinateur ?>"  class="form-control">
                                <?php if(form_error('destinateur')): ?>
                                <div class="alert-danger"><?php echo form_error('destinateur'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Objet</label>
                                <input type="text" name="objet" value="<?= $depart->objet ?>" class="form-control">
                                <?php if(form_error('objet')): ?>
                                <div class="alert-danger"><?php echo form_error('objet'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">N° archives </label>
                                <input type="text" name="num_archive" value="<?= $depart->num_archive ?>" class="form-control">
                                <?php if(form_error('num_archive')): ?>
                                <div class="alert-danger"><?php echo form_error('num_archive'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Observation</label>
                                <input type="text" name="observation" value="<?= $depart->observation ?>" class="form-control">
                                <?php if(form_error('observation')): ?>
                                <div class="alert-danger"><?php echo form_error('observation'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group file btn btn-info mb-3">
                        La pièce jointe &nbsp;
                        <i class="fas fa-upload"></i>
                        <input type="hidden" name="ancien_file" class="form-control " value="<?= $depart->piece_jointe ?>">
                        <input type="file" accept=".xls,.xlsx,.pdf,.png,.jpeg" name="piece_jointe" />
                    </div>
                    <input type="hidden" name="created_at" value="<?= date('Y/m/d')?>">
                    <div class="form-group">
                        <button type="submit" name="modifier" class="btn btn-info">Modifier</button>
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>