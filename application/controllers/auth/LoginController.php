<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if($this->session->has_userdata('connecter'))
        // {
        //     $this->session->set_flashdata('statut', 'Vous êtes déjà connecter.!');
        //     redirect(base_url('dashbord'));
        // }
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('UsersModel');
    }

    public function index()
    {
        $data['page_title'] = 'Connexion';
        $this->load->view('auth/template/p_entete', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/template/p_pied', $data);
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required|md5');

        if($this->form_validation->run() == FALSE)
        {
            //failed
            $this->index();
        }
        else
        {
            $data = array(
                'email'  => $this->input->post('email'),
                'password'  => $this->input->post('password'),
            );
            $user = new UsersModel;

            $verification = $user->loginUser($data);

            if($verification != FALSE && $verification->active == 1)
            {
                $auth_usedetail = [
                    'user_id' => $verification->id_user,
                    'nomcomplet' => $verification->nomcomplet,
                    'email' => $verification->email,
                    'adresse' => $verification->adresse,
                    'tel' => $verification->tel,
                    'image' => $verification->image,
                    'role' => $verification->role_id,
                ];

                // 1=administrateur, 2=utilisateur
                $this->session->set_userdata('connecter',$verification->role_id);
                $this->session->set_userdata('auth_user', $auth_usedetail);
                $this->session->set_flashdata('msg', 'Connecter avec succès.!');
                redirect(base_url('dashboard'));
            }
            else
            {
                #$this->session->set_flashdata('msg_error', "Vous êtes peut être bloquer, appeler l'administrateur.!");
                $this->session->set_flashdata('msg_error', "Email et ou Mot de passe incorrect.!");
                redirect(base_url('connexion'));
            }
        }
    }
}

?>