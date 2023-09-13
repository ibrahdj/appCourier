<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
       
    }

    //La methode index
    public function index()
    {
        $data['page_title'] = 'Profile utilisateur';
        $this->load->view('templates/entete_page', $data);
        $this->load->view('templates/barre_lateral', $data);
        $this->load->view('auth/profile');
        $this->load->view('templates/pied_page', $data);
    }
}
?>