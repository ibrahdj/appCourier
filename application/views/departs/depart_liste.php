<style>
    th.rotate {
        height:80px;
        white-space: nowrap;
        position:relative;
    }

    th.rotate > div {
        transform: rotate(-90deg);
        position:absolute;
        left:0;
        right:0;
        top: 22px;
        margin:auto;
    }
    .num{
        left:0;
        right:0;
        white-space: nowrap;
        position:relative;
        margin: auto;
        
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
                <div class="text-uppercase text-info text-center align-middle">
                    <span class="h1"><b>Départ</b></span>
                    <a href="<?php echo base_url('depart/add'); ?>" class="btn btn-primary float-right"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase align-middle" style="widht: 10px;">n°</th>
                            <th class="text-center text-uppercase align-middle rotate">
                                <div><span>numéros<br>d'orde</span></div>
                            </th>
                            <th class="text-center text-uppercase align-middle rotate">
                                <div><span>nombre<br>de pièces</span></div>
                            </th>
                            <th class="text-center text-uppercase align-middle"><span>Date<br>du départ</span></th>
                            <th class="text-center text-uppercase align-middle"><span>d e s t i n a t a i r e</span></th>
                            <th class="text-center text-uppercase align-middle"><span>n°<br>archives</span></th>
                            <th class="text-center text-uppercase align-middle" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                        foreach ($depart as $dep):?>
                        <tr>
                            <td class="text-center align-middle num" style="width: 10px;"><?= $i?></td>
                            <td class="text-center align-middle"><?= $dep->num_ordre?></td>
                            <td class="text-center align-middle"><?= $dep->nbre_piece?></td>
                            <td class="text-center align-middle"><?= date('d/m/Y', strtotime($dep->date_depart))?></td>
                            <td class="text-center align-middle"><?= $dep->destinateur?></td>
                            <td class="text-center align-middle"><?= $dep->num_archive?></td>
                            <td class="text-center align-middle">
                                <div class="col-md-12">
                                    <a href="<?= base_url('depart/edit/'.$dep->id_depart); ?>" class="btn btn-primary "><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a href="<?= base_url('depart/show/'.$dep->id_depart); ?>" class="btn btn-secondary"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                    <?php if ($this->session->userdata('auth_user')['role']  == 1):?>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $dep->id_depart; ?>"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                            <div id="myModal<?= $dep->id_depart; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog ">
                                        <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class=" modal-title">Confirmation</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Voulez-vous supprimer ? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <a  href="<?= base_url('depart/delete/'.$dep->id_depart); ?>" class="btn btn-danger">Oui</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>