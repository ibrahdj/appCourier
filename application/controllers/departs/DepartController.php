<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('DepartModel');
        $this->load->model('Authentication');
    }

    //Debut de la methode index//
    public function index()
    {
        $data['page_title'] = 'Courrier Départ';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $depart = $this->DepartModel->getDepart();
        $this->load->view('departs/depart_liste', ['depart'=>$depart]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode index//

    //Debut de la methode create//
    public function create()
    {
        $data['page_title'] = 'Courrier Départ';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('departs/depart_create', $data);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode create//

    //Debut de la methode store//
    public function store()
    {
        $this->form_validation->set_rules('num_ordre','N° d\'ordre', 'required');
        $this->form_validation->set_rules('nbre_piece','Nombre de pièces', 'required');
        $this->form_validation->set_rules('date_depart','Date du départ', 'required');
        $this->form_validation->set_rules('destinateur','Destinateur', 'required');
        $this->form_validation->set_rules('objet','Objet', 'required');
        $this->form_validation->set_rules('num_archive','N° archives', 'required');
        $this->form_validation->set_rules('observation','Observation', 'required');
        if($this->form_validation->run())
        {        
            $date = new \DateTime();            
            $config['allowed_types'] = 'pdf|xls|xlsx|jpeg|png';
            $config['upload_path'] = './assets/uploads_depart/';
            $config['max_size']    = '1000000';
            $new_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('piece_jointe'))
            {
                $upload_data = $this->upload->data();
                $data = [
                    'num_ordre' => $this->input->post('num_ordre'),
                    'nbre_piece' => $this->input->post('nbre_piece'),
                    'date_depart' => $this->input->post('date_depart'),
                    'destinateur' => $this->input->post('destinateur'),
                    'objet' => $this->input->post('objet'),
                    'num_archive' => $this->input->post('num_archive'),
                    'observation' => $this->input->post('observation'),
                    'created_at' => $this->input->post('created_at'),
                    'piece_jointe' => '',
                ];

                
                $this->DepartModel->insertDepart($data);
                $this->session->set_flashdata('status','Courrier Depart enregistrer avec succès.');
                redirect(base_url('depart'));
            }
            else
            {
                $upload_data = $this->upload->data();
                //get the uploaded file name
                $data = [
                    'num_ordre' => $this->input->post('num_ordre'),
                    'nbre_piece' => $this->input->post('nbre_piece'),
                    'date_depart' => $this->input->post('date_depart'),
                    'destinateur' => $this->input->post('destinateur'),
                    'objet' => $this->input->post('objet'),
                    'num_archive' => $this->input->post('num_archive'),
                    'observation' => $this->input->post('observation'),
                    'created_at' => $this->input->post('created_at'),
                    'piece_jointe' => $upload_data['file_name'],
                ];

                
                $this->DepartModel->insertDepart($data);
                $this->session->set_flashdata('status','Courrier depart enregistrer avec succès.');
                redirect(base_url('depart'));
            }                     
        }
        else
        {
            $this->create();
        }
    }
    //Fin de la methode store//

    //Debut de la methode show//
    public function show($id)
    {
        $data['page_title'] = 'Depart';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $depart = $this->DepartModel->download($id);
        $this->load->view('departs/depart_show', ['depart'=>$depart]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode show//

    //Debut de la methode download//
    public function download($id)
    {
        $data['page_title'] = 'Courrier Départ';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->helper('download');
        
        $depart = $this->DepartModel->download($id);
        $file = './assets/uploads_depart/'.$depart['piece_jointe'];
        if(file_exists($file)){
            force_download($file, NULL);
        }
        else
        {
            $this->session->set_flashdata('pas_fichier','Le fichier '.$depart['piece_jointe'].' n\'existe pas / ou peut être déplacer .');
        }
        
        $this->load->view('departs/depart_show', ['depart'=>$depart]);
        $this->load->view('template/pied_page', $data);
	}
    //Fin de la methode download//

    //Debut de la methode preview//
    public function preview($id)
    {
        $this->load->helper('download');
        
        $depart = $this->DepartModel->download($id);
        $extension = pathinfo($depart['piece_jointe'], PATHINFO_EXTENSION);
        $file = './assets/uploads_depart/'.$depart['piece_jointe'];
        if(!file_exists($file)){
            $this->session->set_flashdata('pas_fichier', "Le fichier ".$depart['piece_jointe']." n'exist pas");
        }
        if (!is_readable($file)) {
            $this->session->set_flashdata('pas_fichier',"Le fichier".$depart['piece_jointe']." n'est pas lisible");
        }
        echo '<html>'
                .header('Content-Type: application/'.$extension).'<br>'
                .header('Content-Disposition: inline; filename="'.$depart['piece_jointe'].'"').'<br>'; // feel free to change the suggested filename
                '<body>'
                .'<object   style="overflow: hidden; height: 100%;
                    width: 100%; position: absolute;" height="100%" width="100%" data="'.$file.'" type="application/'.$extension.'">
                    <embed src="'.$file.'" type="application/'.$file.'" />
                </object>'
                .'</body>'
                . '</html>';
                @readfile($file);
        exit;
    }
    //Fin de la methode preview//

    //Debut de la methode edit//
    public function edit($id)
    {
        $data['page_title'] = 'Courrier Départ';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        
        $depart = $this->DepartModel->editDepart($id);
        $this->load->view('departs/depart_edit', ['depart'=>$depart]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode edit//

    //Debut de la methode update//
    public function update($id)
    {
        $this->form_validation->set_rules('num_ordre','N° d\'ordre', 'required');
        $this->form_validation->set_rules('nbre_piece','Nombre de pièces', 'required');
        $this->form_validation->set_rules('date_depart','Date du départ', 'required');
        $this->form_validation->set_rules('destinateur','Destinateur', 'required');
        $this->form_validation->set_rules('objet','Objet', 'required');
        $this->form_validation->set_rules('num_archive','N° archives', 'required');
        $this->form_validation->set_rules('observation','Observation', 'required');
        
        if($this->form_validation->run())
        {   
            $ancien_name = $this->input->post('ancien_file');
            $newfichier = $_FILES['piece_jointe']['name'];
            $date = new \DateTime();
            if ($newfichier == TRUE) 
            {
                $update_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);
                $config = [
                    'upload_path' => "./assets/uploads_depart/",
                    'allowed_types' => "pdf|xls|xlsx|jpeg|png",
                    'file_name' => $update_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('piece_jointe'))
                {        
                    if (file_exists('./assets/uploads_depart/'.$ancien_name)) 
                    {
                        unlink('./assets/uploads_depart/'.$ancien_name);
                    }        
                }
            }
            else
            {
                $update_name = $ancien_name;
            }
            
            $data = [
                'num_ordre' => $this->input->post('num_ordre'),
                'nbre_piece' => $this->input->post('nbre_piece'),
                'date_depart' => $this->input->post('date_depart'),
                'destinateur' => $this->input->post('destinateur'),
                'objet' => $this->input->post('objet'),
                'num_archive' => $this->input->post('num_archive'),
                'observation' => $this->input->post('observation'),
                'updated_at' => $this->input->post('created_at'),
                'piece_jointe' => $update_name,
            ];
            $this->DepartModel->updateDepart($data, $id);
            $this->session->set_flashdata('status','Courrier depart modifier avec succès.');
            redirect(base_url('depart'));
        }
        else
        {
            return $this->edit($id);
        }
    }
    //Fin de la methode update//
    
    //Debut de la methode test_delete//
    // public function delete($id)
    // {
    //     
    //     $this->DepartModel->deletDepart($id);
    //     $this->session->set_flashdata('status', 'Courrier depart supprimer avec succès');
    //     redirect(base_url('depart'));
    // }
    //Debut de la methode test_delete//

    //Debut de la methode delete//
    public function delete($id)
    {
        $depart = new DepartModel;
        if ($depart->checkCourrierFile($id)) 
        {
            $data = $depart->checkCourrierFile($id);
            // $data->piece_jointe;
            if (file_exists("./assets/uploads_depart/".$data->piece_jointe)) 
            {
                unlink("./assets/uploads_depart/".$data->piece_jointe);
            }
            $depart->deletdepart($id);
            $this->session->set_flashdata('status', 'Courrier depart supprimer avec succès');
            redirect(base_url('depart'));
        }
        
    }
    //Debut de la methode delete//
}
?>