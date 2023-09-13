<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('connecter'))
        {
            if($this->session->userdata('connecter') == '2')
            {
                //echo "Vous êtes utilisateur";
            }
        }
        else
        {
            $this->session->set_flashdata('status','Connectez-vous');
            redirect(base_url('connexion'));
        }
    }

    public function isAdmin()
    {
        if($this->session->has_userdata('connecter'))
        {
            if($this->session->userdata('connecter') != '1')
            {
                $this->session->set_flashdata('error','Accès réfuser.! Ressayez encore');
                redirect(base_url('403'));
            }
        }
        else
        {
            $this->session->set_flashdata('status','Connectez-vous');
            redirect(base_url('connexion'));
        }
    }
}

?>