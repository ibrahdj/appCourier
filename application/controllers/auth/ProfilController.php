<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
        $this->load->model('UsersModel');
       
    }

    //La methode index
    public function index()
    {
        $data['page_title'] = 'Profil utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $this->load->view('auth/profil');
        $this->load->view('template/pied_page', $data);
    }

    public function show($id)
    {
        $data['page_title'] = 'Profil utilisateur';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        $user['user'] = $this->UsersModel->editUser($id);
        $user['user']->role = $this->UsersModel->editUser_Role($id);
        $user['user']->role_all = $this->UsersModel->getRole();
        $this->load->view('auth/profil', $user);
        $this->load->view('template/pied_page', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nomcomplet', 'Nom Complet', 'trim|required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required');
        $this->form_validation->set_rules('tel', 'Téléphone', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('password','Password','trim|required|md5');
        // $this->form_validation->set_rules('conf_pass','Confirm password','trim|required|matches[password]|md5');

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
            $data = [
                'nomcomplet' => $this->input->post('nomcomplet'),
                'email'  => $this->input->post('email'),
                'adresse' => $this->input->post('adresse'),
                'tel' => $this->input->post('tel'),
                'image' => $update_name,
            ];
            $register_use = new UsersModel;

            $register_use->updateUser($data, $id);
            $this->session->set_flashdata('status', 'User créer avec succès.!');
            redirect(base_url('dashboard'));

        }
        else
        {
            //failed
            $this->show($id);
        }
    }

    public function delete_image($id)
    {
        $user = new UsersModel;
        if ($user->checkuserFile($id)) 
        {
            $data_image = $user->checkuserFile($id);
            $data = [
                'image' => '',
            ];

            // $data->piece_jointe;
            if (file_exists("./assets/upload_users/".$data_image->image)) 
            {
                unlink("./assets/upload_users/".$data_image->image);
            }
            $user->updateUser($data, $id);
            $this->session->set_flashdata('status', 'Photo supprimer avec succès');
            redirect(base_url('dashboard'));
        }
        
    }

    public function changePassword($id)
    {
        $this->form_validation->set_rules('old_password','Mot de passe actuel','trim|required|md5');
        $this->form_validation->set_rules('newpassword','Nouveau mot de passe','trim|required|md5');
        $this->form_validation->set_rules('renewpassword','Remettre à nouveau','trim|required|matches[newpassword]|md5');

        if($this->form_validation->run() == FALSE)
        {
            //failed
            $this->show($id);
        }
        else
        {
            $dataTest = array(
                'password'=> $this->input->post('old_password')
            );
            
            $verifid = $this->UsersModel->testPassword($dataTest);
            if ($verifid == TRUE) 
            {

                $data = array(
                    'password'  => $this->input->post('newpassword'),
                );
                $user = new UsersModel;
    
                $verification = $user->updateUser($data, $id);

                $this->session->set_flashdata('status', 'Mot de passe modifier avec succès.');
                $this->show($id);
            } else 
            {
                $this->session->set_flashdata('errorP', 'Mot de passe saisie n\'est pas bonne, svp ressayer encore.!');
                $this->show($id);
            }
            
        }
    }
}
?>