<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ActiviteModel extends CI_Model
{
    public function __construct() {
        parent::__construct();
      
        /* Load Models - PersonneModel */
        $this->load->model('PersonneModel');
    }

    //Methode get all personne
    public function getPersonne()
    {
        $req = $this->PersonneModel->getPers();
        return $req;
    }

    //Methode edit activite, personne, participation
    public function editeParticipant_Pers_Act($id = FALSE)
    {
        if($id===FALSE){
            $this->db->select('*');
            $this->db->form('activite');
            $this->db->join('participant', 'participant.activite_id = activite.id_activite');
            $this->db->join('personne', 'personne.id_personne = participation.personne_id');
            $query = $this->db->get();
            return $query->row();
        }
        $query = $this->db->get_where('activite',['id_activite'=>$id]);
        return $query->row();
    }

    //READ
    function get_activites(){
        $this->db->select('activite.*,COUNT(id_personne) AS item_personne');
        $this->db->from('activite');
        $this->db->join('participant', 'id_activite=activite_id');
        $this->db->join('personne', 'personne_id=id_personne');
        $this->db->group_by('id_activite');
        $query = $this->db->get();
        return $query->result();
    }

    //INSERT ACTIVITE
    public function insertActivite($data = array())
    {
        if(!empty($data))
        { 
            $req = $this->db->insert('activite', $data);
            return $req?$this->db->insert_id():false;
        } 
        return false;
    }

    //INSERT ACTIVITE_ID IN PARTICIPANT
    public function insertPart($data = array()) { 
        if(!empty($data))
        { 
            $insert = $this->db->insert_batch('participant', $data); 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }

    //EDIT ACTIVITE
    public function editeActivite($id)
    {
        $req = $this->db->get_where('activite', ['id_activite' => $id]);
        return $req->row();
    }

    //Methode get edit personne
    public function getPersonneID($id)
    {
        $query = $this->PersonneModel->editePers($id);
        return $query;
    }

    public function getParticipant()
    {
        $req = $this->db->get('participant');
        return $req->result();
    }

    public function editePartID($id)
    {
        $req = $this->db->get_where('participant', ['id_activite' => $id]);
        return $req->row();
    }

    // DELETE
    function delete_package($id){
        $this->db->trans_start();
        $this->db->delete('activite', array('id_activite' => $id));
        $this->db->delete('participant', array('activite_id' => $id));
        $this->db->trans_complete();
    }

    //Delete participant
    public function deletePart($id)
    {
        $req = $this->db->delete('participant', array('activite_id' => $id));
    }

    // UPDATE
    public function update_activite($data, $id) { 
        if(!empty($data) && !empty($id)){ 

            // Update comite data 
            $update = $this->db->update('activite', $data, array('id_activite' => $id)); 
             
            // Return the status 
            return $update?true:false; 
        } 
        return false; 
    }
    

    public function countRowActe() {
        $this->db->select('*');
        $this->db->from('activite');
        $id = $this->db->get()->num_rows();
        return $id;
    }

    


    


}
?>