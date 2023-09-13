<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('ContactModel');
        $this->load->model('Authentication');
    }

    public function index()
    {
        $data['page_title'] = 'Contact';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $contact = $this->ContactModel->getContact();
        $this->load->view('show_contact', ['contact' => $contact]);
        $this->load->view('template/pied_page', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Contact';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('contact');
        $this->load->view('template/pied_page', $data);
    }

    public function edit($id)
    {

    }

    public function show($id)
    {
        
    }

    public function store()
    {
        $this->form_validation->set_rules('nomcomplet', 'Nom Complet', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('object','Objet','required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        
        if($this->form_validation->run() == FALSE)
        {
            $this->create();

        }
        else
        {
            $dataTest = array(
                'nomcomplet' => $this->input->post('nomcomplet'),
                'email'  => $this->input->post('email'),
            );
            $verifed = $this->ContactModel->loginUser($dataTest);
            
            if ($verifed == TRUE) {
                // $this->session->set_flashdata('status', 'Le nom et l\'email correct');
                // redirect(base_url('contact/add'));
                $data = [
                    'nomcomplet' => $this->input->post('nomcomplet'),
                    'email'  => $this->input->post('email'),
                    'message'  => $this->input->post('message'),
                    'object'  => $this->input->post('object'),
                    'statut' => "Non lu",              
                ];
                $this->ContactModel->insertContact($data);
                $this->session->set_flashdata('status', 'Envoyer avec succès');
                redirect(base_url('dashboard'));
            } else {
                $this->session->set_flashdata('error', 'Le nom ou l\'email saisi est incorrect!');
                redirect(base_url('contact/add'));
            }
            
        }
    }

}
?>