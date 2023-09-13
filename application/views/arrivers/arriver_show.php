
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                <?php if($this->session->flashdata('pas_fichier')): ?>
                <div class="alert alert-danger text-center">
                    <?= $this->session->flashdata('pas_fichier'); ?>
                </div>
                <?php endif; ?>
                    <div class="text-center">
                        <span class="h1"><b>Information du courrier arrivé N°</b><?= $arriver['id_arriv'] ?></span>                        <a href="<?php echo base_url('arriver'); ?>" class="btn btn-danger float-right"> Retour </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>Date arrivé</th>
                                <td>Le <?= date('d/m/Y', strtotime($arriver['date_arriv'])) ?>&nbsp; n° <?= $arriver['num_arriv'] ?></td>
                            </tr>
                            <tr>
                                <th>Date et n° de la correspondance</th>
                                <td>du <?= date('d/m/Y', strtotime($arriver['date_corresp'])) ?>&nbsp; n° <?= $arriver['num_corresp'] ?></td>
                            </tr>
                            <tr>
                                <th>Expéditeur</th>
                                <td><?= $arriver['expediteur'] ?></td>
                            </tr>
                            <tr>
                                <th>Objet</th>
                                <td><?= $arriver['objet'] ?></td>
                            </tr>
                            <tr>
                                <th>Date et n° de la reponse</th>
                                <td>du <?= date('d/m/Y', strtotime($arriver['date_reponse'])) ?>&nbsp; n° <?= $arriver['num_reponse'] ?></td>
                            </tr>
                            <tr>
                            <?php if($arriver['piece_jointe']): ?>
                                <th>Pièce jointe  
                                    <td class="text-primary"> <i class="fas fa-file text-danger">&nbsp; </i> <?= $arriver['piece_jointe'] ?>&nbsp; <a href="<?php echo base_url().'arriver/download/'.$arriver['id_arriv']; ?>" class="badge badge-success">
                                    <i class="fas fa-download"></i></a>&nbsp; <a href="<?php echo base_url().'arriver/preview/'.$arriver['id_arriv']; ?>" class="badge badge-success" target="_blank"><i class="fas fa-file-pdf"></i></a> </td>
                                </th>                                                                
                            <?php endif; ?>
                            </tr>
                            <tr>
                            <?php if($arriver['piece_jointe'] == ''): ?>
                            
                            <th>Pièce jointe  
                                <td class="text-danger">(<i class="fa fa-exclamation"></i>)&nbsp; Pas de pièce jointe pour ce courrier</td>
                            </th>
                            <?php endif; ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>