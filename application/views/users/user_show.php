
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <span class="h1 text-center float-left"><b>Information de l'utilisateur N°</b><?= $user->id_user; ?>
                    <img class="img-circle" src="<?= base_url('./assets/upload_users/'.$user->image) ?>"
                    alt="Photo" style="width: 60px; height: 60px;">
                </span>
                    <a href="<?php echo base_url('register'); ?>" class="btn btn-danger float-right"> Retour </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>Nom complet</th>
                                <td><?= $user->nomcomplet; ?></td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td><?= $user->adresse; ?></td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                <td><?= $user->tel; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href><?= $user->email; ?></a></td>
                            </tr>
                            <tr>
                                <th>Rôle</th>
                                <?php 
                                foreach ($user->role_all as $rol):?>
                                <?php if($user->role_id == $rol->id_role):?>
                                    <td><?= $rol->lib_role; ?></td>
                                <?php endif; ?>
                                <?php 
                                endforeach;
                                ?>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php 
                                if ($user->active == 0) {
                                    echo '<div class="text-danger">Inactif</div>';
                                }
                                else {
                                    echo  '<div class="text-success">Actif</div>';
                                } 
                                ?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>