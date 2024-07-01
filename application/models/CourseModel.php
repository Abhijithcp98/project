<?php
class CourseModel extends CI_Model{
    public function getAllCourses()
    {
        $this->db->get('tbl_course')->result_array();
    }
}
?>