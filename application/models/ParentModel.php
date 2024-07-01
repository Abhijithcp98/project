<?php
class ParentModel extends CI_Model{
    public function getAllParents()
    {
        return $this->db->get('tbl_parent')->result_array();
    }
}
?>