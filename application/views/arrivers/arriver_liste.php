

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
                    <span class="h1"><b>Arrivé</b></span>
                    <a href="<?php echo base_url('arriver/add'); ?>" class="btn btn-primary float-right"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase align-middle" style="width: 10px;">n°</th>
                            <th class="text-center text-uppercase align-middle">date<br>arrivé</th>
                            <th class="text-center text-uppercase align-middle">date et n°<br>de la corres<br>pondance</th>
                            <th class="text-center text-uppercase align-middle">e x p d i t e u r</th>
                            <th class="text-center text-uppercase align-middle">Date et n°<br>de la<br>réponse</th>
                            <th class="text-center text-uppercase align-middle" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                        foreach ($arriver as $arriv):?>
                        <tr>
                            <td class="text-center align-middle" style="width: 10px;"><?= $i ?></td>
                            <td class="text-center align-middle">Le <?= date('d/m/Y', strtotime($arriv->date_arriv)) ?><br>n° <?= $arriv->num_arriv ?></td>
                            <td class="text-center align-middle">du <?= date('d/m/Y', strtotime($arriv->date_corresp)) ?><br>n° <?= $arriv->num_corresp ?></td>
                            <td class="text-center align-middle"><?= $arriv->expediteur ?></td>
                            <td class="text-center align-middle">Le <?= date('d/m/Y', strtotime($arriv->date_reponse)) ?><br>n° <?= $arriv->num_reponse ?></td>
                            <td class="text-center align-middle">
                                <div class="col-md-12">
                                    <a href="<?= base_url('arriver/edit/'.$arriv->id_arriv); ?>" class="btn btn-primary "><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a href="<?= base_url('arriver/show/'.$arriv->id_arriv); ?>" class="btn btn-secondary"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                    <?php if ($this->session->userdata('auth_user')['role']  == 1):?>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $arriv->id_arriv; ?>"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                            <div id="myModal<?= $arriv->id_arriv; ?>" class="modal fade" role="dialog">
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
                                            <a  href="<?= base_url('arriver/delete/'.$arriv->id_arriv); ?>" class="btn btn-danger"  >Oui</a>
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