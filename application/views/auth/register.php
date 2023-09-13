<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <span class="h1"><b>Register</b></span>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('status')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('status'); ?>
                </div>
            <?php endif; ?>
            <p class="register-box-msg">Créer un nouveau compte</p>

            <form action="<?php echo base_url('register'); ?>" method="post" enctype="multipart/form-data">
               <div class="from-group mb-3">
                <div class="input-group">
                        <input type="text" name="nomcomplet" value="<?php echo set_value('nomcomplet'); ?>" class="form-control" placeholder="Nom complet">
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
                <div class="form-group mb-3">
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
                <input type="file" name="image" class="form-control" id="">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
            </form>

            <div class="social-auth-links text-center mb-0">
                <span>Avez-vous déjà un compte? <a href="<?php echo base_url('login'); ?>">Connectez-vous</a></span>
            </div>
           
            <!-- /.form-box -->
        </div><!-- /.card -->
        <hr class="hr mt-0">
        <div class="register-box text-center pb-3">
            <span>Copyright &copy; 2023-2024 <a href="#">Scse</a>.</span> Tous droits réservés.
        </div>
<!-- /.register-box -->
