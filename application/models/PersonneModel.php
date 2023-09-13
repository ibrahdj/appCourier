<?php

class PersonneModel extends CI_Model
{
    //La methode get personne
    public function getPers()
    {
        $req = $this->db->get('personne');
        return $req->result();
    }

    //La methode insert personne
    public function insertPers($data)
    {
        return $req = $this->db->insert('personne', $data);
    }

    //La methode edit personne
    public function editPers($id)
    {
        $query = $this->db->get_where('personne', ['id_personne' => $id]);
        return $query->row();
    }

    //La methode update personne
    public function updatePers($data, $id){
        $query = $this->db->update('personne', $data, ['id_personne' => $id]);
    }

    //La methode delete personne
    public function deletePers($id){
        $query = $this->db->delete('personne', ['id_personne' => $id]);
    }

}