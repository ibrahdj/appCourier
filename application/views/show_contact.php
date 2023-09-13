
    <!-- Main content -->
    <section class="row">

        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <?php if($this->session->flashdata('status')): ?>
                <div class="alert alert-success text-center">
                    <?= $this->session->flashdata('status'); ?>
                </div>
                <?php endif; ?>
                <div class="text-uppercase text-info text-center align-middle">
                    <span class="h1"><b>Message Certification</b></span>
                    <a href="<?= base_url('contact/add'); ?>" class="btn btn-primary float-right"> <i class="fa fa-plus" aria-hidden="true"></i> Nouveau</a>
                </div>
            </div>
            <div class="card-body">
                <?php $i = 1; foreach ($contact as $cont):?>
                    <div class="col-12" id="accordion">
                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne<?= $cont->idcontact; ?>">
                            <div class="card-header">
                                <h6 class="card-title w-100">
                                <div class="text-left" style="width: 100%; heigth: 2px;">
                                    <img src="<?= base_url('assets/templates') ?>/dist/img/logo_scse.png" alt="contact" class="img-circle" style="width: 30px; height: 30px;">
                                    <span class="text-dark"><?= $cont->nomcomplet; ?></span> 
                                    <?php if(date('y', strtotime($cont->datecontact)) == date('y')):?>
                                        <span class="float-right text-dark"><?= date('d M', strtotime($cont->datecontact)) ?></span>
                                    <?php endif; ?>
                                    <?php if(date('y', strtotime($cont->datecontact)) != date('y')):?>
                                        <span class="float-right text-dark"><?= date('d/m/Y', strtotime($cont->datecontact)) ?></span>
                                    <?php endif; ?> <br>
                                    <?php if($cont->message != ""):?>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="text-dark"><?= $cont->message; ?></span>
                                    <?php endif; ?>
                                    <?php if($cont->message == ""):?>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="text-dark">(aucun message)</span>
                                    <?php endif; ?>
                                </div>
                                </h6>
                            </div>
                        </a>
                        <div id="collapseOne<?= $cont->idcontact; ?>" class="collapse " data-parent="#accordion">
                            <div class="card-body">
                                <?php if($cont->message != ""):?>
                                <p> <?= $cont->message; ?> </p>
                                <?php endif; ?>
                                <?php if($cont->message == ""):?>
                                    <p>(aucun message)</p>
                                <?php endif; ?>
                            </div>
                            <div class="footer">
                                <span class="float-right mr-2"><?= date('H:m', strtotime($cont->datecontact)) ?></span> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; endforeach;?>
            </div>
        </div>
    </section>
    <!-- /.content -->