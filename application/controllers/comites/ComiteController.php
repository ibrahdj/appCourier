<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComiteController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('ComiteModel');
        $this->load->model('Authentication');
    }

    //Debut de la methode index//
    public function index()
    {
        $comite = array();
        $data['page_title'] = 'Session de la comité';
        $comite['comite'] = $this->ComiteModel->getRows();
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('comites/comite_liste', $comite);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode index//

    //Debut de la methode create//
    public function create()
    {
        $data['page_title'] = 'Session de la comité';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('comites/comite_create', $data);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode create//

    //Debut de la methode store//
    public function store()
    {
        $data = $comiteData = array();

        $this->form_validation->set_rules('agenda','Ordre du jour', 'required');
        $this->form_validation->set_rules('lieu_comite','Lieu du session', 'required');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('date_comite','Date du session', 'required');

        $comiteData = array(
            'agenda' => $this->input->post('agenda'),
            'lieu_comite' => $this->input->post('lieu_comite'),
            'description' => $this->input->post('description'),
            'date_comite' => $this->input->post('date_comite'),
        );

        if($this->form_validation->run() == true)
        {
            $insert = $this->ComiteModel->insertComite($comiteData); 
            $comiteID = $insert;
            if ($insert)
            {
                if (!empty($_FILES['piece_jointe']['name']) && count(array_filter($_FILES['piece_jointe']['name'])) > 0 )
                {
                    $compte_fichier = count($_FILES['piece_jointe']['name']);
                    $date = new \DateTime(); 
                    #$new_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);

                    for($i=0; $i<$compte_fichier; $i++)
                    {
                        $_FILES['file']['name'] = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name'][$i]);
                        $_FILES['file']['type'] = $_FILES['piece_jointe']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['piece_jointe']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['piece_jointe']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['piece_jointe']['size'][$i];

                        $uploadPath = './assets/uploads_comite/';
                        $config['allowed_types'] = 'pdf|xls|xlsx|jpeg|png';
                        $config['upload_path'] = $uploadPath;
                        $config['max_size']    = '50000';

                        // Load and initialize upload library 
                        $this->load->library('upload', $config); 
                        $this->upload->initialize($config);

                        // Upload file to server 
                        if($this->upload->do_upload('file'))
                        { 
                            // Uploaded file data 
                            $fileData = $this->upload->data(); 
                            $uploadData[$i]['comite_id'] = $comiteID; 
                            $uploadData[$i]['piece_jointe'] = $fileData['file_name']; 
                        }
                        else
                        { 
                            $this->session->set_flashdata('error',''.$fileImages[$key].'('.$this->upload->display_errors('', '').') | ');
                            $this->create();
                        } 
                    }
                    // File upload error message 
                    $this->session->set_flashdata('error','Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.');
                    $this->create();
                    if(!empty($uploadData))
                    { 
                         // Insert files info into the database 
                         $insert = $this->ComiteModel->insertArchive($uploadData); 
                    } 
                }
                $this->session->set_flashdata('status','Session enregistrer avec succès.');
                redirect(base_url('comite'));
            }
            else
            {
                $this->session->set_flashdata('error','Des problèmes sont survenus, veuillez réessayer.');
                $this->create();
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
        $data['page_title'] = 'Session de la  comité';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $comite['comite'] = $this->ComiteModel->getRows($id);
        $this->load->view('comites/comite_show', $comite);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode show//

    //Debut de la methode download//
    public function download($id)
    {
        $data['page_title'] = 'Session de la comité';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->helper('download');
        
        $comite = $this->ComiteModel->download($id);
        $file = './assets/uploads_comite/'.$comite['piece_jointe'];
        if(file_exists($file)){
            force_download($file, NULL);
        }
        else
        {
            $this->session->set_flashdata('pas_fichier','Le fichier '.$comite['piece_jointe'].' n\'existe pas / ou peut être déplacer .');
        }
        
        $this->load->view('comites/comite_show', ['comite'=>$comite]);
        $this->load->view('template/pied_page', $data);
	}
    //Fin de la methode download//

    //Debut de la methode preview//
    public function preview($id)
    {
        $this->load->helper('download');
        
        $comite = $this->ComiteModel->download($id);
        $extension = pathinfo($comite['piece_jointe'], PATHINFO_EXTENSION);
        $file = './assets/uploads_comite/'.$comite['piece_jointe'];
        if(!file_exists($file)){
            $this->session->set_flashdata('pas_fichier', "Le fichier ".$comite['piece_jointe']." n'exist pas");
        }
        if (!is_readable($file)) {
            $this->session->set_flashdata('pas_fichier',"Le fichier".$comite['piece_jointe']." n'est pas lisible");
        }
        echo '<html>'
                .header('Content-Type: application/'.$extension).'<br>'
                .header('Content-Disposition: inline; filename="'.$comite['piece_jointe'].'"').'<br>'; // feel free to change the suggested filename
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
        #$comite = array();
        $data['page_title'] = 'Session de la comité';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $comite['comite'] = $this->ComiteModel->getRows($id);
        $this->load->view('comites/comite_edit', $comite);
        $this->load->view('template/pied_page', $data);
    }
    //Fin de la methode edit//

    //Debut de la methode update//
    public function update($id)
    {
        $data = $comiteData = array();

        // Get comite data 
        $comiteData = $this->ComiteModel->getRows($id);

        // Form field validation rules 
        $this->form_validation->set_rules('agenda','Ordre du jour', 'required');
        $this->form_validation->set_rules('lieu_comite','Lieu du session', 'required');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('date_comite','Date du session', 'required');
   
        // Prepare comite data 
        $comiteData = array(
            'agenda' => $this->input->post('agenda'),
            'lieu_comite' => $this->input->post('lieu_comite'),
            'description' => $this->input->post('description'),
            'date_comite' => $this->input->post('date_comite'),
        ); 
             
        // Validate form data 
        if($this->form_validation->run() == true)
        { 
            // Update comite data 
            $update = $this->ComiteModel->update($comiteData, $id);

            if ($update)
            {
                if (!empty($_FILES['piece_jointe']['name']) && count(array_filter($_FILES['piece_jointe']['name'])) > 0 )
                {
                    $compte_fichier = count($_FILES['piece_jointe']['name']);
                    $date = new \DateTime(); 
                    #$new_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name']);

                    for($i=0; $i<$compte_fichier; $i++)
                    {
                        $_FILES['file']['name'] = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['piece_jointe']['name'][$i]);
                        $_FILES['file']['type'] = $_FILES['piece_jointe']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['piece_jointe']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['piece_jointe']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['piece_jointe']['size'][$i];

                        $uploadPath = './assets/uploads_comite/';
                        $config['allowed_types'] = 'pdf|xls|xlsx|jpeg|png';
                        $config['upload_path'] = $uploadPath;
                        $config['max_size']    = '50000';

                        // Load and initialize upload library 
                        $this->load->library('upload', $config); 
                        $this->upload->initialize($config);

                        // Upload file to server 
                        if($this->upload->do_upload('file'))
                        { 
                            // Uploaded file data 
                            $fileData = $this->upload->data(); 
                            $uploadData[$i]['comite_id'] = $id; 
                            $uploadData[$i]['piece_jointe'] = $fileData['file_name']; 
                        }
                        else
                        { 
                            $this->session->set_flashdata('error',''.$fileImages[$key].'('.$this->upload->display_errors('', '').') | ');
                            $this->edit($id);
                        } 
                    }
                    // File upload error message 
                    $this->session->set_flashdata('error','Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.');
                    $this->create();
                    if(!empty($uploadData)){ 
                         // Insert files info into the database 
                         $insert = $this->ComiteModel->insertArchive($uploadData); 
                    } 
                }
                $this->session->set_flashdata('status','Session modifier avec succès.');
                redirect(base_url('comite'));
            }
            else
            {
                $this->session->set_flashdata('error','Des problèmes sont survenus, veuillez réessayer.');
                $this->edit($id);
            }

        }
        else
        {
            $this->edit($id);
        }
    }
    //Fin de la methode update//
    
    public function deleteArchives($piece_jointe){ 
        $archiveData = $this->ComiteModel->getArchiveRow($piece_jointe);
            
        // Delete image data 
        $con = array('piece_jointe' => $piece_jointe);

        $delete = $this->ComiteModel->deleteArchives($con); 
            
        if($delete){ 
            // Remove files from the server  
            @unlink('./assets/uploads_comite/'.$archiveData['piece_jointe']);  
        } 
        else
        {
            redirect(base_url('comite'));
        }
        redirect(base_url('comite'));
    } 


    public function delete($id)
    { 
        // Check whether id is not empty 
        if($id){ 
            $comiteData = $this->ComiteModel->getRows($id); 
            // Delete comite data 
            $delete = $this->ComiteModel->deleteComite($id); 
             
            if($delete){ 
                // Delete images data  
                $condition = array('comite_id' => $id);  
                $deletefile = $this->ComiteModel->deleteArchives($condition);  
                  
                // Remove files from the server  
                if(!empty($comiteData['files'])){  
                    foreach($comiteData['files'] as $arch){  
                        @unlink('./assets/uploads_comite/'.$arch['piece_jointe']);  
                    }  
                } 
                $this->session->set_flashdata('status', 'La session est supprimer avec succès.');
                redirect(base_url('comite'));
            }else{ 
                $this->session->set_flashdata('error', 'Un problème est survenu, svp essayer encore.');
                redirect(base_url('comite'));
            } 
        } 
 
        redirect($this->controller); 
    } 

    
}
?>
