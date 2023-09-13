<!-- style -->
<style>
  .mon-text{
    /* background-image: url('<?= base_url('assets/templates') ?>/dist/img/contact-us.png'); */
    background-image: url('<?= base_url('assets/templates') ?>/dist/img/logo_scse.png');
    background-size:contain;
    max-width: 400px;
    height: 450px;
    background-position: 50% 50%;
    background-repeat: no-repeat;
  }
  .h5, .fa{
    text-align:left;
    margin-left: 14px;
  }
  h2,{
    position: absolute;
    margin-top: -10%;
  }

  .pt-5{
    background-color: black;
    background-color: rgba(0, 0, 0, .30);
    opacity: 0.8;
    padding: 20px;
    border-radius: 60px;
  }
  .icon{
    color: white;
    margin-right: 4px ;
  }
</style>
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-body row">
    <div class="col-5">
      <div class="mon-text text-center align-middle d-flex align-items-center justify-content-center">
        <div class="pt-5 text-light" >
          <h2>Certification</h2>
          <p class="h5"> 
          <i class=" icon bi bi-geo-alt" aria-hidden="true"></i> <span>Hamdallaye ACI-2000</span><br>
          <i class=" icon bi bi-envelope" aria-hidden="true"></i> <span>info@certification.gouv.ml</span> <br>
          <i class=" icon bi bi-telephone" aria-hidden="true"></i> <span>+223 20 01 90 00</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-7">
      <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger text-center">
              <?= $this->session->flashdata('error'); ?>
          </div>
      <?php endif; ?>
      <?php if($this->session->flashdata('status')): ?>
          <div class="alert alert-success text-center">
              <?= $this->session->flashdata('status'); ?>
          </div>
      <?php endif; ?>
      <form action="<?php echo base_url('contact/add'); ?>" method="POST">
        <div class="form-group">
          <label for="nomcomplet">Nom complet</label>
          <input type="text" name="nomcomplet" id="nomcomplet" class="form-control" />
          <?php if(form_error('nomcomplet')): ?>
          <div class="alert-danger"><?php echo form_error('nomcomplet'); ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="email">E-Mail</label>
          <input type="email" name="email" id="email" value="" class="form-control" />
          <?php if(form_error('email')): ?>
          <div class="alert-danger"><?php echo form_error('email'); ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="object">Objet</label>
          <input type="text" name="object" id="object" class="form-control" />
          <?php if(form_error('object')): ?>
          <div class="alert-danger"><?php echo form_error('object'); ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" class="form-control" rows="4"></textarea>
          <?php if(form_error('message')): ?>
          <div class="alert-danger"><?php echo form_error('message'); ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Envoyer le message">
          <a href="<?= base_url('contact'); ?>" class="btn btn-danger" >Retour</a>
        </div>
      </form>
    </div>
  </div>
</div>

</section>
<!-- /.content -->