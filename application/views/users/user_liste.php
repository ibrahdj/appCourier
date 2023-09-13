

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
                    <span class="h1"><b>Liste des utilisateurs</b></span>
                    <?php if ($this->session->userdata('auth_user')['role']  == 1):?>
                    <a href="<?php echo base_url('register/add'); ?>" class="btn btn-primary float-right"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <?php 
                if ($this->session->userdata('auth_user')['role']  == 1):?>
                <table id="example1" class="table table-bordered" style="width: 100%;">
                <?php endif; ?>
                <?php 
                if ($this->session->userdata('auth_user')['role']  == 2):?>
                <table id="" class="table table-bordered" style="width: 100%;">
                <?php endif; ?>
                    <thead>
                    <?php 
                        if ($this->session->userdata('auth_user')['role']  == 1):?>
                        <tr>
                            <th class="text-center text-uppercase align-middle" style="width: 10px;">n°</th>
                            <th class="text-center text-uppercase align-middle" >Nom complet</th>
                            <th class="text-center text-uppercase align-middle" >Email</th>
                            <th class="text-center text-uppercase align-middle" >Téléphone</th>
                            <th class="text-center text-uppercase align-middle" >Rôle</th>
                            <th class="text-center text-uppercase align-middle" >Status</th>
                            <th class="text-center text-uppercase align-middle" >Action</th>
                        </tr>
                        <?php endif; ?>
                        <?php 
                        if ($this->session->userdata('auth_user')['role']  == 2):?>
                        <tr>
                            <th class="text-center text-uppercase align-middle" >Nom complet</th>
                            <th class="text-center text-uppercase align-middle" >Email</th>
                            <th class="text-center text-uppercase align-middle" >Téléphone</th>
                            <th class="text-center text-uppercase align-middle" >Action</th>
                        </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                    <?php 
                        if ($this->session->userdata('auth_user')['role']  == 1):?>
                        <?php $i = 1; 
                        foreach ($user as $us):?>
                        <tr>
                            <td class="text-center align-middle" style="width: 10px;"><?= $i ?></td>
                            <td class="text-center align-middle"><?= $us->nomcomplet ?></td>
                            <td class="text-center align-middle"><a href><?= $us->email ?></a></td>
                            <td class="text-center align-middle"><?= $us->tel ?></td>
                            <td class="text-center align-middle"><?= $us->lib_role ?></td>
                            <td class="text-center align-middle"><?php 
                                if ($us->active == 0) {
                                    echo '<div class="text-danger">Inactif</div>';
                                }
                                else {
                                    echo  '<div class="text-success">Actif</div>';
                                }
                                
                             ?>
                             </td>
                            <td class="text-center align-middle">
                                <div class="col-md-12">
                                    <a href="<?= base_url('register/edit/'.$us->id_user); ?>" class="btn btn-primary "><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a href="<?= base_url('register/show/'.$us->id_user); ?>" class="btn btn-secondary"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $us->id_user; ?>"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                            <div id="myModal<?= $us->id_user; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog ">
                                        <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title">Confirmation</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Voulez-vous supprimer? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <a  href="<?= base_url('register/delete/'.$us->id_user); ?>" class="btn btn-danger">Oui</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $i++;
                        endforeach;
                        ?>
                        <?php endif; ?>
                        <?php 
                        if ($this->session->userdata('auth_user')['role']  == 2):?>
                        <tr>
                            <td class="text-center align-middle"><?= $this->session->userdata('auth_user')['nomcomplet'] ?></td>
                            <td class="text-center align-middle"><?= $this->session->userdata('auth_user')['email'] ?></td>
                            <td class="text-center align-middle"><?= $this->session->userdata('auth_user')['tel'] ?></td>
                            <td class="text-center">
                            <a href="<?= base_url('register/show/'.$this->session->userdata('auth_user')['user_id']); ?>" class="btn btn-secondary"><i class="fas fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
