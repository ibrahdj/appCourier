<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('UsersModel');
        // if($this->session->has_userdata('connecter'))
        // {
        //     $this->session->set_flashdata('statut', 'Vous êtes déjà connecter.!');
        //     redirect(base_url('dashbord'));
        // }
       
    }
    public function index()
    {
        $data['page_title'] = 'Utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $user = $this->UsersModel->getUser();
        $this->load->view('users/user_liste', ['user'=>$user]);
        $this->load->view('template/pied_page', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $role = $this->UsersModel->getRole();
        $this->load->view('users/user_create', ['role'=>$role]);
        $this->load->view('template/pied_page', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules('nomcomplet', 'Nom Complet', 'trim|required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required');
        $this->form_validation->set_rules('tel', 'Téléphone', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','trim|required|md5');
        $this->form_validation->set_rules('conf_pass','Confirm password','trim|required|matches[password]|md5');

        if($this->form_validation->run())
        {
            $date = new \DateTime();            
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['upload_path'] = './assets/upload_users/';
            $config['max_size']    = '1024';
            $new_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['image']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();
                $data = [
                    'nomcomplet' => $this->input->post('nomcomplet'),
                    'email'  => $this->input->post('email'),
                    'adresse' => $this->input->post('adresse'),
                    'tel' => $this->input->post('tel'),
                    'password'  => $this->input->post('password'),
                    'role_id' => 2,
                    'active' => 1,
                    'image' => '',
                ];
                $register_use = new UsersModel;

                $verification = $register_use->registerUser($data);
                if($verification)
                {
                    $this->session->set_flashdata('status', 'User créer avec succès.!');
                    redirect(base_url('register'));
                }
                else
                {
                    $this->session->set_flashdata('status', "Quelque chose s'est mal passé.!");
                    redirect(base_url('register/add'));
                }
            }
            else {
                $upload_data = $this->upload->data();
                $data = [
                    'nomcomplet' => $this->input->post('nomcomplet'),
                    'email'  => $this->input->post('email'),
                    'adresse' => $this->input->post('adresse'),
                    'tel' => $this->input->post('tel'),
                    'password'  => $this->input->post('password'),
                    'role_id' => 2,
                    'active' => 1,
                    'image' => $upload_data['file_name'],
                ];
                $register_use = new UsersModel;

                $verification = $register_use->registerUser($data);
                if($verification)
                {
                    $this->session->set_flashdata('status', 'User créer avec succès.!');
                    redirect(base_url('register'));
                }
                else
                {
                    $this->session->set_flashdata('status', "Quelque chose s'est mal passé.!");
                    redirect(base_url('register/add'));
                }
            }
        }
        else
        {
            //failed
            $this->create();
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $user['user'] = $this->UsersModel->editUser($id);
        $user['user']->role = $this->UsersModel->editUser_Role($id);
        $user['user']->role_all = $this->UsersModel->getRole();
        $this->load->view('users/user_edit',$user);
        $this->load->view('template/pied_page', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nomcomplet', 'Nom Complet', 'trim|required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required');
        $this->form_validation->set_rules('tel', 'Téléphone', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required|md5');
        $this->form_validation->set_rules('conf_pass','Confirm password','trim|required|matches[password]|md5');

        if($this->form_validation->run())
        {
            $ancien_name = $this->input->post('ancien_image');
            $newfichier = $_FILES['image']['name'];
            $date = new \DateTime();
            if ($newfichier == TRUE) {
                $update_name = date_format($date, 'd-m-Y')."-".str_replace(' ','-', $_FILES['image']['name']);
                $config = [
                    'upload_path' => "./assets/upload_users/",
                    'allowed_types' => "jpg|jpeg|png",
                    'max_size' => "1024",
                    'file_name' => $update_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image'))
                {        
                    if (file_exists('./assets/upload_users/'.$ancien_name)) 
                    {
                        unlink('./assets/upload_users/'.$ancien_name);
                    }        
                }
            } 
            else 
            {
                $update_name = $ancien_name;
            }
            if($this->input->post('active') == on)
            {
                $val = 1;
            }
            else{
                $val = 0;
            }
            $data = [
                'nomcomplet' => $this->input->post('nomcomplet'),
                'email'  => $this->input->post('email'),
                'adresse' => $this->input->post('adresse'),
                'tel' => $this->input->post('tel'),
                'password'  => $this->input->post('password'),
                'role_id' => $this->input->post('role_id'),
                'active' => $val,
                'image' => $update_name,
            ];
            $register_use = new UsersModel;

            $register_use->updateUser($data, $id);
            $this->session->set_flashdata('status', 'User créer avec succès.!');
            redirect(base_url('register'));
        }
        else
        {
            //failed
            $this->edit($id);
        }
    }

    public function show($id)
    {
        $data['page_title'] = 'Utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $user['user'] = $this->UsersModel->editUser($id);
        $user['user']->role = $this->UsersModel->editUser_Role($id);
        $user['user']->role_all = $this->UsersModel->getRole();
        $this->load->view('users/user_show',$user);
        $this->load->view('template/pied_page', $data);
    }

    public function delete($id)
    {
        $user = new UsersModel;
        if ($user->checkuserFile($id)) 
        {
            $data = $user->checkuserFile($id);
            // $data->piece_jointe;
            if (file_exists("./assets/upload_users/".$data->image)) 
            {
                unlink("./assets/upload_users/".$data->image);
            }
            $user->deletUser($id);
            $this->session->set_flashdata('status', 'Utilisateur supprimer avec succès');
            redirect(base_url('register'));
        }
        
    }    

}



?>