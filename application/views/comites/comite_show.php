
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
                        <span class="h1"><b>Information de la session N°</b><?= $comite['id_comite'] ?></span>
                        <a href="<?php echo base_url('comite'); ?>" class="btn btn-danger float-right"> Retour </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>Ordre du jour</th>
                                <td><?= $comite['agenda'] ?></td>
                            </tr>
                            <tr>
                                <th>Lieu de la session</th>
                                <td><?= $comite['lieu_comite'] ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?= $comite['description'] ?></td>
                            </tr>
                            <tr>
                                <th>Date de la session</th>
                                <td><?= date('d/m/Y', strtotime($comite['date_comite'])) ?></td>
                            </tr>
                            <tr>
                                <?php if(!empty($comite['files'])){ ?>
                                    <th>Les pièces jointes </th>
                                    <td class="text-primary">
                                        <?php foreach($comite['files'] as $fileRow){ ?>
                                            <i class="fas fa-file text-danger" aria-hidden="true"></i>&nbsp;
                                            <?= $fileRow['piece_jointe']; ?>&nbsp; 
                                            <a href="<?php echo base_url().'comite/download/'.$fileRow['piece_jointe']; ?>" class="badge badge-success">
                                            <i class="fas fa-download"></i>
                                            </a>&nbsp;&nbsp;
                                            <a class="badge badge-success" href="<?php echo base_url().'comite/preview/'.$fileRow['piece_jointe']; ?>" target="_blank">
                                            <i class="fa fa-file-pdf"></i>
                                            </a>&nbsp;&nbsp;&nbsp;
                                        <?php }; ?>
                                    </td>                                                               
                                <?php }; ?>
                            </tr>
                            <tr>
                                <?php if(empty($comite['files'])){ ?>
                                <th>Les pièces jointes  
                                    <td class="text-danger"> (<i class="fa fa-exclamation"></i>)&nbsp; Pas de pièce jointe pour ce courrier</td>
                                </th>
                                <?php }; ?>
                            </tr>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
