

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
                    <span class="h1 text-center"><b>Information du courrier de départ N°</b><?= $depart['id_depart'] ?></span>
                    <a href="<?php echo base_url('depart'); ?>" class="btn btn-danger float-right"> Retour </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered w-100">
                            <tr>
                                <th>N° d'ordre</th>
                                <td><?= $depart['num_ordre'] ?></td>
                            </tr>
                            <tr>
                                <th>Nombre de pièces</th>
                                <td><?= $depart['nbre_piece'] ?></td>
                            </tr>
                            <tr>
                                <th>Date du depart</th>
                                <td>Le <?= date('d/m/Y', strtotime($depart['date_depart'])) ?></td>
                            </tr>
                            <tr>
                                <th>Destinataire</th>
                                <td><?= $depart['destinateur'] ?></td>
                            </tr>
                            <tr>
                                <th>Objet</th>
                                <td><?= $depart['objet'] ?></td>
                            </tr>
                            <tr>
                                <th>N° Archives</th>
                                <td><?= $depart['objet'] ?></td>
                            </tr>
                            <tr>
                                <th>Observation</th>
                                <td><?= $depart['observation'] ?></td>
                            </tr>                   
                            <tr>
                            <?php if($depart['piece_jointe']): ?>
                                <th>Pièce jointe  
                                    <td class="text-primary"> <i class="fas fa-file text-danger">&nbsp; </i> <?= $depart['piece_jointe'] ?>&nbsp; <a href="<?php echo base_url().'depart/download/'.$depart['id_depart']; ?>" class="badge badge-success">
                                    <i class="fas fa-download"></i></a>&nbsp; <a href="<?php echo base_url().'depart/preview/'.$depart['id_depart']; ?>" class="badge badge-success" target="_blank"><i class="fas fa-file-pdf"></i></a> </td>
                                </th>                                                                
                            <?php endif; ?>
                            </tr>
                            <tr>
                            <?php if($depart['piece_jointe'] == ''): ?>
                            
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