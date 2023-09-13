<!-- Small boxes (Stat box) -->
<div class="row">
  <!-- ./col -->
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $nbreA ?></h3>

        <p class="text-uppercase">Courrier ARRIVÉ <span class="h5">(
        <?= round((($nbreA * 100) / ($nbreA + $nbreD)) )?>%<sup style="font-size: 20px"></sup>
        )</span></p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <?php 
      if ($this->session->userdata('auth_user')['role']  == 1):?>
      <a href="<?= base_url('arriver')?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
      <?php endif; ?>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $nbreD ?></h3>

        <p class="text-uppercase">COURRIER DÉPART <span class="h5">(
        <?= round((($nbreD * 100) / ($nbreA + $nbreD)) )?>%<sup style="font-size: 20px"></sup>
        )</span></p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <?php 
      if ($this->session->userdata('auth_user')['role']  == 1):?>
      <a href="<?= base_url('depart')?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
      <?php endif; ?>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?= ($nbreA + $nbreD) ?></h3>

        <p class="text-uppercase" >Total des courriers</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <?php 
      if ($this->session->userdata('auth_user')['role']  == 1):?>
        <a href="#" class="small-box-footer">COURRIER [ ARRIVÉ + DÉPART ]</a>
      <?php endif; ?>
      
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-6 connectedSortable">
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
        <h3 class="card-title form-inline"> COURRIER ARRIVÉ &nbsp;
          <div class="input-group">
            <input type="text" id="myFilter" size="25" class="form-control" onkeyup="myFunction()" placeholder="Rechercher par nom..">
            <div class="input-group-append">
              <div class="input-group-text bg-primary">
                  <span class="fas fa-search"></span>
              </div>
            </div>
          </div>
        </h3>
        <div class="card-tools">
          <?php $sum = 0; foreach ($arriver as $arriv):?>
              <?php if ($arriv): $sum ++;?>
              <?php endif; ?>
          <?php endforeach; ?>
          <span title="<?= $sum ?>&nbsp; Courrier d'arriver " class="badge badge-primary"><?= $sum ?></span>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body" id="myItems">
      <!-- date('d', strtotime($arriv->created_at)) <= date('d') -->
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
          <?php foreach ($arriver as $arriv):?>
            <?php if($arriv): ?>
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg">
              <div class="direct-chat-infos clearfix" >
                <span class="direct-chat-name float-left"><?= $arriv->expediteur?></span>
                <span class="direct-chat-timestamp float-right"><?= date('d/m/Y', strtotime($arriv->date_arriv)) ?></span>
              </div>
              <!-- /.direct-chat-infos -->
              <?php if($arriv->piece_jointe): ?>
              <i class="fa fa-file fa-3x direct-chat-img text-danger"></i>
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text text-primary py-2">
                <?= $arriv->piece_jointe ?><a href="<?php echo base_url().'arriver/preview/'.$arriv->id_arriv; ?>" class="btn-success btn-sm float-right" target="_blank"><i class="fas fa-file-pdf-o "></i></a>
              </div>
              <?php endif; ?>

              <?php if($arriv->piece_jointe == ''): ?>
              <i class="fa fa-exclamation text-danger fa-3x direct-chat-img"></i>
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text text-danger">
              Pas de pièce jointe pour ce courrier
              </div>
              <?php endif; ?>
              <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <!--/.direct-chat-messages-->
      <!-- /.card-body -->
      </div>
    </div>
    <!--/.direct-chat -->
  </section>
  <section class="col-lg-6 connectedSortable">
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
        <h3 class="card-title form-inline"> COURRIER DÉPART &nbsp;
          <div class="input-group">
            <input type="text" id="myFilter1" size="25" class="form-control" onkeyup="myFunction1()" placeholder="Rechercher par nom..">
            <div class="input-group-append">
              <div class="input-group-text bg-primary">
                  <span class="fas fa-search"></span>
              </div>
            </div>
          </div>
        </h3>
        <div class="card-tools">
          <div class="card-tools">
          <!-- date('d') >= date('d', strtotime($dep->created_at)) -->
            <?php
                $sum = 0;
                foreach ($depart as $dep)
                if ($dep) {
                  $sum ++;
                }
                  
            ?>
            <span title="<?= $sum ?>&nbsp; Courrier de depart " class="badge badge-primary"><?= $sum ?></span>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body" id="myItems1">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
          <!-- Message. Default to the left -->
          <?php $i = 1; 
          foreach ($depart as $dep):?>
          <?php if($dep): ?>
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-left"><?= $dep->destinateur?></span>
              <span class="direct-chat-timestamp float-right"><?= date('d/m/Y', strtotime($dep->date_depart)) ?></span>
            </div>
            <!-- /.direct-chat-infos -->
            <?php if($dep->piece_jointe): ?>
            <i class="fa fa-file fa-3x direct-chat-img text-danger"></i>
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text text-primary py-2">
              <?= $dep->piece_jointe ?><a href="<?php echo base_url().'depart/preview/'.$dep->id_depart; ?>" class="btn-success btn-sm float-right" target="_blank"><i class="fa fa-file-pdf-o "></i></a>
            </div>
            <?php endif; ?>

            <?php if($dep->piece_jointe == ''): ?>
            <i class="fa fa-exclamation text-danger fa-3x direct-chat-img"></i>
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text text-danger">
            Pas de pièce jointe pour ce courrier
            </div>
            <?php endif; ?>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
          <?php endif; ?>
          <?php 
          $i++;
          endforeach;
          ?>
      

        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!--/.direct-chat -->
  </section>
  <!-- right col -->
  <section class="col-lg-12 connectedSortable">
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
        <h3 class="card-title form-inline">  SESSION DE LA COMITÉ &nbsp; &nbsp;
        <div class="input-group">
            <input type="text" id="myFilter2" size="50" class="form-control" onkeyup="myFunction2()" placeholder="Rechercher par nom..">
            <div class="input-group-append">
              <div class="input-group-text bg-primary">
                  <span class="fas fa-search"></span>
              </div>
            </div>
          </div>
        </h3>
        <div class="card-tools">
          <div class="card-tools">
            <?php
                $sum = 0;
                foreach ($comite as $comt)
                if ($comt) {
                  $sum ++;
                }
            ?>
            <span title="<?= $sum ?>&nbsp; Session effectuer " class="badge badge-primary"><?= $sum; ?> </span>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body" id="myItems2">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
          <!-- date('d', strtotime($comt['date_comite'])) <= date('d') -->
          <!-- Message. Default to the left -->
          <?php $i = 1; 
          foreach ($comite as $comt):?>
          <?php if($comt): ?>
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-left"><?= $comt['agenda']?> </span>
              <span class="direct-chat-timestamp float-right"><?= date('d/m/Y', strtotime($comt['date_comite'])) ?></span>
            </div>
            <!-- /.direct-chat-infos -->
            <?php if(!empty($comite)){ ?>
              <?php foreach($getC_A as $fileRow){ ?>
                <?php if($comt['id_comite'] == $fileRow->comite_id){ ?>
              <i class="fa fa-file fa-3x direct-chat-img text-danger mb-3"></i>
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text text-primary py-2 mb-3">
                <?= $fileRow->piece_jointe ?>
                <a href="<?php echo base_url().'comite/preview/'.$fileRow->piece_jointe; ?>" target="_blank" class="btn-success btn-sm float-right">
                  <i class="fa fa-file-pdf-o "></i>
                </a>
              </div>
              <?php }; ?>
              <?php }; ?>
            <?php }; ?>

            <?php if(empty($comite)): ?>
            <i class="fa fa-exclamation text-danger fa-3x direct-chat-img"></i>
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text text-danger">
            Pas de pièce jointe pour ce courrier
            </div>
            <?php endif; ?>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
          <?php endif; ?>
          <?php 
          $i++;
          endforeach;
          ?>
        </div>
      </div>
      <div class="col-md-12 text-center p-2 bg-light">
        <?php if ($this->session->userdata('auth_user')['role']  == 1):?>
          <a href="<?= base_url('comite')?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
        <?php endif; ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!--/.direct-chat -->
  </section>
  <section class="col-lg-6 connectedSortable">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-0 row">
          <div class="d-flex justify-content-between form-inline">
            <h3 class="card-title text-center">COURRIER  ARRIVÉ &nbsp; &nbsp;
            <select name="year" id="year"  class="form-control">
              <?php
              foreach($getArYear as $row)
              {
                echo '<option value="'.$row->anne.'">'.$row->anne.'</option>';
              }
              ?>
            </select>
            </h3>
          </div>
        </div>
        <div class="card-body">
          <div class="position-relative mb-4">
            <canvas id="arriver-chart" height="200"></canvas>
          </div>
          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> Cette année
            </span>
            <span>
              <i class="fas fa-square text-gray"></i> Année passé
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- bottom col -->
  <section class="col-lg-6 connectedSortable">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-0 row">
          <div class="d-flex justify-content-between form-inline">
            <h3 class="card-title">COURRIER DÉPART &nbsp; &nbsp;
            <select name="year1" id="year1" class="form-control">
              <?php
              foreach($getYear as $row)
              {
                echo '<option value="'.$row->anne.'">'.$row->anne.'</option>';
              }
              ?>
            </select>
            </h3>
          </div>
        </div>
        <div class="card-body">
          <div class="position-relative mb-4">
            <canvas id="depart-chart" height="200"></canvas>
          </div>
          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> Cette année
            </span>
            <span>
              <i class="fas fa-square text-gray"></i> Année passé
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
</div>
<!-- /.row (main row) -->

