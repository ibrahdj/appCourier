<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonneController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('PersonneModel');
        $this->load->model('Authentication');
    }

    public function index()
    {
        $data['page_title'] = 'Personnel';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $personne = $this->PersonneModel->getPers();
        $this->load->view('personnes/personne_liste', ['personne'=>$personne]);
        $this->load->view('template/pied_page', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Personnel';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('personnes/personne_create');
        $this->load->view('template/pied_page', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = 'Personnel';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $personne = $this->PersonneModel->editPers($id);
        $this->load->view('personnes/personne_edit',['personne'=>$personne]);
        $this->load->view('template/pied_page', $data);
    }

    public function show($id)
    {
        $data['page_title'] = 'Personnel';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $personne = $this->PersonneModel->editPers($id);
        $this->load->view('personnes/personne_show',['personne'=>$personne]);
        $this->load->view('template/pied_page', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('tel','Téléphone','required');
        $this->form_validation->set_rules('fonction', 'Fonction exercer', 'required');
        
        if($this->form_validation->run())
        {
            $data = [
                'prenom' => $this->input->post('prenom'),
                'nom' => $this->input->post('nom'),
                'tel'  => $this->input->post('tel'),
                'fonction'  => $this->input->post('fonction'),
                'email'  => $this->input->post('email'),
                
            ];
            $this->PersonneModel->insertPers($data);
            $this->session->set_flashdata('status', 'Personne enregistrer avec succès');
            redirect(base_url('personne'));
        }
        else
        {
            $this->create();
        }
        
    }

    public function update($id){

        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('tel','Téléphone','required');
        $this->form_validation->set_rules('fonction', 'Fonction exercer', 'required');
        #$this->form_validation->set_rules('email', 'Email', 'required');

        if($this->form_validation->run()):
            
            $data = [
                'prenom' => $this->input->post('prenom'),
                'nom' => $this->input->post('nom'),
                'tel'  => $this->input->post('tel'),
                'fonction'  => $this->input->post('fonction'),
                'email'  => $this->input->post('email'),
                
            ];

            $this->PersonneModel->updatePers($data, $id);
            $this->session->set_flashdata('status', 'Personne modifier avec succès');
            redirect(base_url('personne'));
        else :

            $this->edit($id);
        endif;
    }

    public function delete($id){
        $this->PersonneModel->deletePers($id);
        $this->session->set_flashdata('status', 'Personne supprimer avec succès');
        redirect(base_url('personne'));
    }
}
?>