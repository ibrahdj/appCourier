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
                <span class="h1"><b>Editer la session N°</b><?php if(!empty($comite)){?> <?=$comite['id_comite'] ?> <?php };?></span>
                <a href="<?php echo base_url('comite'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('comite/update/'.$comite['id_comite'] ); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ordre du jour</label>
                                <input type="text" name="agenda" value="<?= $comite['agenda'] ?>" class="form-control">
                                <?php if(form_error('agenda')): ?>
                                <div class="alert-danger"><?php echo form_error('agenda'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Lieu de la session</label>
                                <input type="text" name="lieu_comite" value="<?= $comite['lieu_comite'] ?>"  class="form-control">
                                <?php if(form_error('lieu_comite')): ?>
                                <div class="alert-danger"><?php echo form_error('lieu_comite'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc">Description </label>
                                <textarea type="text" class="form-control" name="description"  id="desc" rows="3"><?= $comite['description']?></textarea>
                                <?php if(form_error('description')): ?>
                                <div class="alert-danger"><?php echo form_error('description'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date de la session </label>
                                <input type="Date" name="date_comite" value="<?= $comite['date_comite'] ?>" class="form-control">
                                <?php if(form_error('date_comite')): ?>
                                <div class="alert-danger"><?php echo form_error('date_comite'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-3 pt-2">
                            <label for=""></label>
                            <div class="form-group">
                            <span class="btn btn-info btn-file" title="Ajouter une pièce">Ajouter les pièces jointes &nbsp;
                                <i class="fas fa-upload"></i><input type="file" accept=".xls,.xlsx,.pdf,.png,.jpeg" name="piece_jointe[]" multiple/>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-3 pt-2">
                            <label for=""></label>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active dropdown">
                                    <a class="nav-link dropdown-toggle btn btn-success btn-sm" href="" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                                    <span class="text-white">Voir les pièces jointes associers</span> </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-4">
                                        <?php if(!empty($comite['files'])){ ?>        
                                            <ul class="list-group list-group-bordered">
                                                <?php foreach($comite['files'] as $fileRow){ ?>
                                                <li class="list-group-item" id="archL_<?= $fileRow['piece_jointe'];?>" >
                                                    <input type="hidden" name="ancien_file" class="form-control " value="<?= $fileRow['piece_jointe']; ?>">
                                                    <i class="fas fa-file text-danger" aria-hidden="true"></i>&nbsp;
                                                    <?= $fileRow['piece_jointe']; ?>&nbsp;
                                                    <a class="badge badge-success" href="<?php echo base_url().'comite/preview/'.$fileRow['piece_jointe']; ?>" target="_blank">
                                                        <i class="fa fa-file-pdf"></i>
                                                    </a> &nbsp;
                                                    <a class="badge badge-danger" href="<?php echo base_url().'comite/deleteArchive/'.$fileRow['piece_jointe'];?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="modifier" class="btn btn-info">Modifier</button> &nbsp;
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
