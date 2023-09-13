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
                <span class="h1"><b>Editer l'utilisateur N°</b><?= $user->id_user; ?></span>
                <a href="<?php echo base_url('register'); ?>" class="btn btn-danger float-right"> Retour </a>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('register/update/'.$user->id_user); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="from-group">
                                <div class="input-group">
                                    <input type="text" name="nomcomplet" value="<?= $user->nomcomplet; ?>" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('nomcomplet')): ?>
                                <span class="text-danger"><?php echo form_error('nomcomplet'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="email" name="email" value="<?= $user->email; ?>" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('email')): ?>
                                <div class="text-danger"><?php echo form_error('email'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="adresse" name="adresse" class="form-control" value="<?= $user->adresse; ?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-address-book"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('adresse')): ?>
                                <span class="text-danger"><?php echo form_error('adresse'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="text" name="tel" class="form-control" value="<?= $user->tel; ?>" data-inputmask='"mask": "(999) 99-99-99-99"' data-mask>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-phone"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('tel')): ?>
                                <span class="text-danger"><?php echo form_error('tel'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('password')): ?>
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="password" name="conf_pass" class="form-control" placeholder="Remettre password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(form_error('conf_pass')): ?>
                                <span class="text-danger"><?php echo form_error('conf_pass'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <select name="role_id" id="" class="form-select form-control select2">
                                        <?php 
                                        foreach ($user->role_all as $rol):?>
                                        <?php if($user->role_id == $rol->id_role):?>
                                        <option value="<?= $rol->id_role ?>"> <?= $rol->lib_role ?> </option>
                                        <?php endif; ?>
                                        <?php 
                                        endforeach;
                                        ?>
                                        <option value="<?= $rol->id_role ?>"> <?= $rol->lib_role ?> </option>
                                    </select>
                                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-chevron-down"></span></div></div>
                                </div>
                                <?php if(form_error('role_id')): ?>
                                <div class="alert-danger"><?php echo form_error('role_id'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <input type="hidden" name="ancien_image" value="<?= $user->image ?>">
                        <div class="col-md-4 mb-3">
                            <div class="form-group file btn btn-info mb-3">
                                Ajouter une photo &nbsp;
                                <i class="fas fa-upload"></i>
                                <input type="file" accept=".png,.jpeg" name="image"  />
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-check">
                                
                                <input class="form-check-input" type="checkbox" name="active" id="active" <?php if($user->active == 1) {echo 'checked = "checked"';} ?>>
                                <label class="form-check-label <?php if($user->active == 1) {echo 'text-primary';} ?>" for="active">Activer/Desactiver</label>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="enregistrer" class="btn btn-info">Modifier</button>
                        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>