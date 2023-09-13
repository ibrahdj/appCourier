<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArriverController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('ArriverModel');
        $this->load->model('Authentication');
    }

    //Debut de la methode index//
    public function index()
    {
        $data['page_title'] = 'Courrier Arrivé';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $arriver = $this->ArriverModel->getArriver();
        $this->load->view('arrivers/arriver_liste', ['arriver'=>$arriver]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode index//

    //Debut de la methode create//
    public function create()
    {
        $data['page_title'] = 'Courrier Arrivé';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('arrivers/arriver_create', $data);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode create//

    //Debut de la methode store//
    public function store()
    {
        $this->form_validation->set_rules('date_arriv','Date d\'arriver', 'required');
        $this->form_validation->set_rules('num_arriv','N° d\'arriver', 'required');
        $this->form_validation->set_rules('date_corresp','Date correspondance', 'required');
        $this->form_validation->set_rules('num_corresp','N° correspondance', 'required');
        $this->form_validation->set_rules('expediteur','Expéditeur', 'required');
        $this->form_validation->set_rules('objet','Objet', 'required');
        $this->form_validation->set_rules('date_reponse','Date reponse', 'required');
        $this->form_validation->set_rules('num_reponse','N° reponse', 'required');

        if($this->form_validation->run())
        {        
            $date = new \DateTime();            
            $config['allowed_types'] = 'pdf|xls|xlsx|jpeg|png';
            $config['upload_path'] = './assets/uploads_arriver/';
            $config['max_size']    = '1000000';
            $new_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('piece_jointe'))
            {
                $upload_data = $this->upload->data();
                $data = [
                    'date_arriv' => $this->input->post('date_arriv'),
                    'num_arriv' => $this->input->post('num_arriv'),
                    'date_corresp' => $this->input->post('date_corresp'),
                    'num_corresp' => $this->input->post('num_corresp'),
                    'expediteur' => $this->input->post('expediteur'),
                    'objet' => $this->input->post('objet'),
                    'date_reponse' => $this->input->post('date_reponse'),
                    'num_reponse' => $this->input->post('num_reponse'),
                    'created_at' => $this->input->post('created_at'),
                    'piece_jointe' => '',
                ];

                $this->ArriverModel->insertArriver($data);
                $this->session->set_flashdata('status','Courrier Arriver enregistrer avec succès.');
                redirect(base_url('arriver'));
            }
            else
            {
                $upload_data = $this->upload->data();
                //get the uploaded file name
                $data = [
                    'date_arriv' => $this->input->post('date_arriv'),
                    'num_arriv' => $this->input->post('num_arriv'),
                    'date_corresp' => $this->input->post('date_corresp'),
                    'num_corresp' => $this->input->post('num_corresp'),
                    'expediteur' => $this->input->post('expediteur'),
                    'objet' => $this->input->post('objet'),
                    'date_reponse' => $this->input->post('date_reponse'),
                    'num_reponse' => $this->input->post('num_reponse'),
                    //'piece_jointe' => $this->input->post('piece_jointe'),
                    'created_at' => $this->input->post('created_at'),
                    'piece_jointe' => $upload_data['file_name'],
                ];

                $this->ArriverModel->insertArriver($data);
                $this->session->set_flashdata('status','Courrier Arriver enregistrer avec succès.');
                redirect(base_url('arriver'));
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
        $data['page_title'] = 'Courrier Arrivé';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $arriver = $this->ArriverModel->download($id);
        $this->load->view('arrivers/arriver_show', ['arriver'=>$arriver]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode show//

    //Debut de la methode download//
    public function download($id)
    {
        $data['page_title'] = 'Courrier Arrivé';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->helper('download');
        $arriver = $this->ArriverModel->download($id);
        $file = './assets/uploads_arriver/'.$arriver['piece_jointe'];
        if(file_exists($file)){
            force_download($file, NULL);
        }
        else
        {
            $this->session->set_flashdata('pas_fichier','Le fichier '.$arriver['piece_jointe'].' n\'existe pas / ou peut être déplacer .');
        }
        
        $this->load->view('arrivers/arriver_show', ['arriver'=>$arriver]);
        $this->load->view('template/pied_page', $data);
	}
    //Fin de la methode download//

    //Debut de la methode preview//
    public function preview($id)
    {
        $this->load->helper('download');
        $arriver = $this->ArriverModel->download($id);
        $extension = pathinfo($arriver['piece_jointe'], PATHINFO_EXTENSION);
        $file = './assets/uploads_arriver/'.$arriver['piece_jointe'];
        if(!file_exists($file)){
            $this->session->set_flashdata('pas_fichier', "Le fichier ".$arriver['piece_jointe']." n'exist pas");
        }
        if (!is_readable($file)) {
            $this->session->set_flashdata('pas_fichier',"Le fichier".$arriver['piece_jointe']." n'est pas lisible");
        }
        echo '<html>'
                .header('Content-Type: application/'.$extension).'<br>'
                .header('Content-Disposition: inline; filename="'.$arriver['piece_jointe'].'"').'<br>'; // feel free to change the suggested filename
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
        $data['page_title'] = 'Courrier Arrivé';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $arriver = $this->ArriverModel->editArriver($id);
        $this->load->view('arrivers/arriver_edit', ['arriver'=>$arriver]);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode edit//

    //Debut de la methode update//
    public function update($id)
    {
        $this->form_validation->set_rules('date_arriv','Date d\'arriver', 'required');
        $this->form_validation->set_rules('num_arriv','N° d\'arriver', 'required');
        $this->form_validation->set_rules('date_corresp','Date correspondance', 'required');
        $this->form_validation->set_rules('num_corresp','N° correspondance', 'required');
        $this->form_validation->set_rules('expediteur','Expéditeur', 'required');
        $this->form_validation->set_rules('objet','Objet', 'required');
        $this->form_validation->set_rules('date_reponse','Date reponse', 'required');
        $this->form_validation->set_rules('num_reponse','N° reponse', 'required');
        
        if($this->form_validation->run())
        {   
            $ancien_name = $this->input->post('ancien_file');
            $newfichier = $_FILES['piece_jointe']['name'];
            $date = new \DateTime();
            if ($newfichier == TRUE) 
            {
                $update_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);
                $config = [
                    'upload_path' => "./assets/uploads_arriver/",
                    'allowed_types' => "pdf|xls|xlsx|jpeg|png",
                    'file_name' => $update_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('piece_jointe'))
                {        
                    if (file_exists('./assets/uploads_arriver/'.$ancien_name)) 
                    {
                        unlink('./assets/uploads_arriver/'.$ancien_name);
                    }        
                }
            }
            else
            {
                $update_name = $ancien_name;
            }
            
            $data = [
                'date_arriv' => $this->input->post('date_arriv'),
                'num_arriv' => $this->input->post('num_arriv'),
                'date_corresp' => $this->input->post('date_corresp'),
                'num_corresp' => $this->input->post('num_corresp'),
                'expediteur' => $this->input->post('expediteur'),
                'objet' => $this->input->post('objet'),
                'date_reponse' => $this->input->post('date_reponse'),
                'num_reponse' => $this->input->post('num_reponse'),
                'updated_at' => $this->input->post('created_at'),
                'piece_jointe' => $update_name,
            ];

            $this->ArriverModel->updateArriver($data, $id);
            $this->session->set_flashdata('status','Courrier Arriver modifier avec succès.');
            redirect(base_url('arriver'));
        }
        else
        {
            return $this->edit($id);
        }
    }
    //Fin de la methode update//

    //Debut de la methode delete//
    public function delete($id)
    {
        $arriver = new ArriverModel;
        if ($arriver->checkCourrierFile($id)) 
        {
            $data = $arriver->checkCourrierFile($id);
            // $data->piece_jointe;
            if (file_exists("./assets/uploads_arriver/".$data->piece_jointe)) 
            {
                unlink("./assets/uploads_arriver/".$data->piece_jointe);
            }
            $arriver->deletArriver($id);
            $this->session->set_flashdata('status', 'Courrier Arriver supprimer avec succès');
            redirect(base_url('arriver'));
        }
        
    }
    //Debut de la methode delete//
}
?>