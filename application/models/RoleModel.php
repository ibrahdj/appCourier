<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RoleModel extends CI_Model
{
    public function getRole()
    {
        $req = $this->db->get('role');
        return $req->result();
    }

    public function insertRole($data)
    {
        $req = $this->db->insert('role', $data);
        return $req;
    }

    public function editRole($id)
    {
        $req = $this->db->get_where('role', ['id_role' => $id]);
        return $req->row();
    }

    public function updateRole($data, $id)
    {
        $req = $this->db->update('role', $data, ['id_role' => $id]);
    }

    public function deleteRole($id)
    {
        $req = $this->db->delete('role', ['id_role' => $id]);
    }
}
?>