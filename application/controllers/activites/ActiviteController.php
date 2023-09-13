<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActiviteController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('ActiviteModel');
        $this->load->model('PersonneModel');
        $this->load->model('Authentication');
    }

    public function index()
    {
        $data['page_title'] = 'Activite';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $activite['personne'] = $this->ActiviteModel->getPersonne();
        $activite['activite'] = $this->ActiviteModel->get_activites();
        #$activite = $this->ActiviteModel->getActivite();
        $this->load->view('activites/activite_liste',$activite);
        $this->load->view('template/pied_page');
    }

    public function create()
    {
        $data['page_title'] = 'Activite';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $personne = $this->ActiviteModel->getPersonne();
        $this->load->view('activites/activite_create', ['personne'=>$personne]);
        $this->load->view('template/pied_page');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Activite';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);

        $activite['activite'] = $this->ActiviteModel->editeActivite($id);
        $activite['activite'] = $this->ActiviteModel->editeParticipant_Pers_Act($id);
        $activite['activite']->part_all = $this->ActiviteModel->getParticipant();
        $activite['activite']->personne_all = $this->ActiviteModel->getPersonne();
        $this->load->view('activites/activite_edit', $activite);
        $this->load->view('template/pied_page');
    }

    public function store()
    {   
        $data = $activiteData = array();

        $this->form_validation->set_rules('lieu_activite','Lieu de l\'activité', 'required');
        $this->form_validation->set_rules('heure_debut','Heure du debut', 'required');
        $this->form_validation->set_rules('heure_fin','Heure du fin', 'required');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('date_activite','Date de l\'activité', 'required');

        $activiteData = array(
            'lieu_activite' => $this->input->post('lieu_activite'),
            'heure_debut' => $this->input->post('heure_debut'),
            'heure_fin' => $this->input->post('heure_fin'),
            'description' => $this->input->post('description'),
            'date_activite' => $this->input->post('date_activite'),
        );

        if($this->form_validation->run() == true)
        {
            $insert = $this->ActiviteModel->insertActivite($activiteData); 
            $activieID = $insert;
            if ($insert)
            {
                $personnes = $this->input->post('personne_id');
                $data = array();
                foreach($personnes as $key => $pers)
                {
                    $data[$key]['activite_id'] = $activieID;
                    $data[$key]['personne_id'] = $pers;
                }
                if (!empty($data)) {
                    $insert = $this->ActiviteModel->insertPart($data);
                    $this->session->set_flashdata('status','Activite enregistrer avec succès.');
                    redirect(base_url('activite'));
                }
            }
            else
            {
                $this->session->set_flashdata('status','Des problèmes sont survenus, veuillez réessayer encore.');
                $this->create();
            }
        }
        else
        {
            $this->create();
        }
        
    }

    public function show($id)
    {
        $data['page_title'] = 'Activite';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);

        $activite['activite'] = $this->ActiviteModel->editeActivite($id);
        $activite['activite'] = $this->ActiviteModel->editeParticipant_Pers_Act($id);
        $activite['activite']->part_all = $this->ActiviteModel->getParticipant();
        $activite['activite']->personne_all = $this->ActiviteModel->getPersonne();
        $this->load->view('activites/activite_show', $activite);
        $this->load->view('template/pied_page');
    }

    public function update($id)
    {
        $data = $activiteData = array();

        $this->form_validation->set_rules('lieu_activite','Lieu de l\'activité', 'required');
        $this->form_validation->set_rules('heure_debut','Heure du debut', 'required');
        $this->form_validation->set_rules('heure_fin','Heure du fin', 'required');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('date_activite','Date de l\'activité', 'required');

        $activiteData = array(
            'lieu_activite' => $this->input->post('lieu_activite'),
            'heure_debut' => $this->input->post('heure_debut'),
            'heure_fin' => $this->input->post('heure_fin'),
            'description' => $this->input->post('description'),
            'date_activite' => $this->input->post('date_activite'),
        );

        if($this->form_validation->run() == true)
        {
            $update = $this->ActiviteModel->update_activite($activiteData, $id); 
            if ($update)
            {
                $personnes = $this->input->post('personne_id');
                $data = array();
                foreach($personnes as $key => $pers)
                {
                    $data[$key]['activite_id'] = $id;
                    $data[$key]['personne_id'] = $pers;
                }
                if (!empty($data)) {
                    $deletePart = $this->ActiviteModel->deletePart($id);
                    $insert = $this->ActiviteModel->insertPart($data);
                    $this->session->set_flashdata('status','Activite modifier avec succès.');
                    redirect(base_url('activite'));
                }
            }
            else
            {
                $this->session->set_flashdata('status','Des problèmes sont survenus, veuillez réessayer.');
                $this->edit($id);
            }
        }
        else
        {
            $this->edit($id);
        }
           
    }

    // DELETE
    public function delete($id)
    {
        if ($id) {
            $this->ActiviteModel->delete_package($id);
            $this->session->set_flashdata('status','Activite supprimer avec succès.');
            redirect(base_url('activite'));
        } else {
            $this->session->set_flashdata('status','Des problèmes sont survenus, svp veuillez réessayer encore.');
            redirect(base_url('activite'));
        }
        
    }

}
?>