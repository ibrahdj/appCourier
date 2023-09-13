<?php

class UsersModel extends CI_Model
{
    public function __construct() {
        parent::__construct();
      
        /* Load Models - Model_1 */
        $this->load->model('RoleModel');
    }

    public function getUs()
    {
        $req = $this->db->get('users');
        return $req->result();
    }

    public function registerUser($data)
    {
        return $this->db->insert('users', $data);
    }

    public function loginUser($data)
    {
        $this->db->select('*');
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $this->db->from('users');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }

    public function testPassword($data)
    {
        $this->db->select('*');
        $this->db->where('password', $data['password']);
        $this->db->from('users');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }

    public function getUser()
    {
        //Methode get article
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('role', 'users.role_id = role.id_role','inner');
        $req = $this->db->get();
        return $req->result();
    }

     //Methode edit article
     public function editUser($id)
     {
         $query = $this->db->get_where('users', ['id_user' => $id]);
         return $query->row();
     }

    //Methode edit user, role
    public function editUser_Role($id = FALSE)
    {
        if($id===FALSE){
            $this->db->select('*');
            $this->db->form('users');
            $this->db->join('role', 'role.id_role = user.id_user');
            $query = $this->db->get();
            return $query->row();
        }
        $query = $this->db->get_where('users',['id_user'=>$id]);
        return $query->row();
    }

    public function updateUser($data, $id)
    {
        $req = $this->db->update('users', $data, ['id_user' => $id]);
    }

    public function deletUser($id)
    {
        $req = $this->db->delete('users', ['id_user' => $id]);
    }

    public function checkuserFile($id)
    {
        $req = $this->db->get_where('users', ['id_user' => $id]);
        return $req->row();
    }
    //Methode get all role
    public function getRole()
    {
        $req = $this->RoleModel->getRole();
        return $req;
    }

    //Methode get edit catégorie
    public function getRoleID($id)
    {
        $query = $this->RoleModel->editRole($id);
        return $query;
    }

    public function countRowD() {
        $this->db->select('*');
        $this->db->from('users');
        $id = $this->db->get()->num_rows();
        return $id;
    }
}

?>