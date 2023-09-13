

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle mb-2"
                src="<?= base_url('./assets/upload_users/'.$user->image) ?>"
                alt="Photo de l'utilisateur">                       
        </div>
        <div class="row">
          <div class="col-md-12">
          <h3 class="profile-username text-center"><?= $this->session->userdata('auth_user')['nomcomplet']; ?></h3>
          </div>
        </div>
        <?php 
        foreach ($user->role_all as $rol):?>
        <?php if ($user->role_id == $rol->id_role): ?>
          <p class="text-muted text-center"><?= $rol->lib_role; ?> </p>
        <?php endif ?>
        <?php 
        endforeach;
        ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">La vue d'ensemble</a></li>
          <li class="nav-item"><a class="nav-link" href="#profile-edit" data-toggle="tab">Editer Profil</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
          <li class="nav-item"><a class="nav-link" href="#profile-change-password" data-toggle="tab">Changer le mot de passe</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <ul class="list-group list-group-unbordered mb-3">
            <span class="h2 mb-4"><b>Détail du profil</b></span>
              <li class="list-group-item">
                <b>Nom complet</b> <a class="float-right"><?= $this->session->userdata('auth_user')['nomcomplet']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?= $this->session->userdata('auth_user')['email']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Adresse</b> <a class="float-right"><?= $this->session->userdata('auth_user')['adresse']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Téléphone</b> <a class="float-right"><?= $this->session->userdata('auth_user')['tel']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Rôle</b> <a class="float-right">
                <?php 
                foreach ($user->role_all as $rol):?>
                <?php if ($user->role_id == $rol->id_role): ?>
                  <?= $rol->lib_role; ?>
                <?php endif ?>
                <?php 
                endforeach;
                ?>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane fade pt-2" id="profile-change-password">
            <!-- Change Password Form -->
            <?php if($this->session->flashdata('status')): ?>
                <div class="alert alert-success mb-4 text-center">
                    <?= $this->session->flashdata('status'); ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('errorP')): ?>
                <div class="alert alert-success mb-4 text-center">
                    <?= $this->session->flashdata('errorP'); ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url('profil/changePassword/'.$user->id_user); ?>" method="POST">

              <div class="row mb-3">
                <label for="ancien_password" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                <div class="col-md-8 col-lg-9">
                  <input name="old_password" type="password" class="form-control" id="ancien_password">
                  <?php if(form_error('old_password')): ?>
                    <span class="text-danger"><?php echo form_error('old_password'); ?></span>
                  <?php endif; ?>
                  <?php if ($this->session->flashdata('errorP')): ?>
                    <span class="text-danger"><?= $this->session->flashdata('errorP') ; ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                <div class="col-md-8 col-lg-9">
                  <input name="newpassword" type="password" class="form-control" id="newPassword">
                  <?php if(form_error('newpassword')): ?>
                    <span class="text-danger"><?php echo form_error('newpassword'); ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Remettre à nouveau</label>
                <div class="col-md-8 col-lg-9">
                  <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  <?php if(form_error('renewpassword')): ?>
                    <span class="text-danger"><?php echo form_error('renewpassword'); ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-md-7 pt-3">
                <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
              </div>
            </form><!-- End Change Password Form -->

          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            <!-- Settings Form -->
            <form>
              <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                <div class="col-md-8 col-lg-9">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changesMade" checked>
                    <label class="form-check-label" for="changesMade">
                      Changes made to your account
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newProducts" checked>
                    <label class="form-check-label" for="newProducts">
                      Information on new products and services
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="proOffers">
                    <label class="form-check-label" for="proOffers">
                      Marketing and promo offers
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                    <label class="form-check-label" for="securityNotify">
                      Security alerts
                    </label>
                  </div>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form><!-- End settings Form -->
          </div>
          <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
            <!-- Profile Edit Form -->
            <form action="<?php echo base_url('profil/update/'.$user->id_user); ?>" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image du profil</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="hidden" name="ancien_image" value="<?= $user->image; ?>">
                    <img src="<?= base_url('./assets/upload_users/'.$user->image) ?>" alt="Photo utilisateur" style="width: 100px; height: 100px;">
                    <div class="pt-2">
                      <span class="btn btn-primary btn-sm btn-file" title="Changer ou ajouter une photo"><i class="bi bi-upload"></i><input type="file" accept=".jpg,.png,.jpeg" name="image"/></span>
                      <a href="" data-toggle="modal" data-target="#myModal<?= $user->id_user; ?>" class="btn btn-danger btn-sm" title="Supprimer image du profile" aria-hidden="true"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>


                <div id="myModal<?= $user->id_user; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog ">
                                <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class=" modal-title">Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">Êtes-vous sûr de vouloir supprimer? </p>
                                </div>
                                <div class="modal-footer">
                                    <a  href="<?= base_url('profile/delete_image/'.$user->id_user) ?>" class="btn btn-danger"  >Oui</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Non</button>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="row mb-3">
                  <label for="nom" class="col-md-4 col-lg-3 col-form-label">Nom complet</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="nomcomplet" type="text" class="form-control" id="nom" <?php if ($this->session->userdata('auth_user')['role']  == 2):?> disabled <?php endif; ?> value="<?= $this->session->userdata('auth_user')['nomcomplet'] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="email" <?php if ($this->session->userdata('auth_user')['role']  == 2):?> disabled <?php endif; ?> value="<?= $this->session->userdata('auth_user')['email'] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="adresse" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="adresse" type="text" class="form-control" id="adresse" value="<?= $this->session->userdata('auth_user')['adresse'] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="tel" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="tel" type="text" class="form-control" id="tel" value="<?= $this->session->userdata('auth_user')['tel'] ?>">
                  </div>
                </div>

                <div class="col-md-7">
                  <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->