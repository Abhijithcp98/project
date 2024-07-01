<?php
class StudentModel extends CI_Model{
    public function getAllStudents()
    {
        return $this->db->get('tbl_student')->result_array();
    }
}
?>