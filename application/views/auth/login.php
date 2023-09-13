<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
        <div class="card-header text-center mb-2">
            <span class="h1"><b><a href>Authentification</a></b></span>
         </div>
        <div class="card-body mb-2">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert-success text-center align-middle mb-3">
                    <?= $this->session->flashdata('msg'); ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('msg_error')): ?>
                <div class="alert-danger text-center align-middle mb-3">
                    <?= $this->session->flashdata('msg_error'); ?>
                </div>
            <?php endif; ?>
            <p class="login-box-msg">
            <img src="<?= base_url('assets/templates') ?>/dist/img/logo_scse.png"
             alt="Certification Logo" class="brand-image" style="opacity: .8; width:100px; heigth:90px;"> <br>
            </p>

            <form action="<?php echo base_url('connexion'); ?>" method="post">
                <div class="form-group mb-4">
                    <div class="input-group">
                        <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email">
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
                <div class="form-group mb-4">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
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
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                        <!-- <span>Vous n'avez pas de compte? <a href="<?php echo base_url('register'); ?>">Créer</a></span> -->
                    </div>
                    <!-- /.col-md-12 -->
                </div>
            </form>
            <!-- <div class="social-auth-links text-center mt-2 mb-3">
                <a href="<?php echo base_url('register'); ?>">Mot de passe oublié</a>
            </div> -->
            <!-- /.social-auth-links -->            
        </div>
        <!-- /.card-body -->
        <!-- Gradient divider -->
        <p class="divider-text"><span class="bg-white"> Si un problème persiste appeler l'administrateur </span></p>
        <div class="register-box text-center pb-3">
            <strong > <a href="#" >SCSE &copy;</a></strong> 2023-2024
        </div>