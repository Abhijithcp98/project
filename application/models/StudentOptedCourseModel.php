<?php
class StudentOptedCourseModel extends CI_Model {

    public function countAllStudents() {
        return $this->db->count_all('tbl_student_opted_course');
    }

    public function countFilteredStudents($searchTerm) {
        $this->db->from('tbl_student_opted_course');
        $this->db->join('tbl_student', 'tbl_student.id = tbl_student_opted_course.student_id');
        $this->db->join('tbl_parent', 'tbl_parent.id = tbl_student.parent_id');
        $this->db->join('tbl_course', 'tbl_course.id = tbl_student_opted_course.course_id');
    
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('tbl_student.name', $searchTerm);
            $this->db->or_like('tbl_parent.name', $searchTerm);
            $this->db->or_like('tbl_course.courseName', $searchTerm);
            $this->db->group_end();
        }
    
        return $this->db->count_all_results();
    }
    
    public function searchData($searchTerm, $limit, $start) {
        $this->db->select('tbl_student.id as student_id, tbl_student.name as student_name, tbl_parent.name as parent_name, tbl_course.courseName as course_name, tbl_student_opted_course.is_active');
        $this->db->from('tbl_student_opted_course');
        $this->db->join('tbl_student', 'tbl_student.id = tbl_student_opted_course.student_id');
        $this->db->join('tbl_parent', 'tbl_parent.id = tbl_student.parent_id');
        $this->db->join('tbl_course', 'tbl_course.id = tbl_student_opted_course.course_id');
        
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('tbl_student.name', $searchTerm);
            $this->db->or_like('tbl_parent.name', $searchTerm);
            $this->db->or_like('tbl_course.courseName', $searchTerm);
            $this->db->group_end();
        }
    
        $this->db->order_by('tbl_student.name', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getStudentsPerPage($limit, $start) {
        $this->db->select('tbl_student.id as student_id, tbl_student.name as student_name, tbl_parent.name as parent_name, tbl_course.courseName as course_name, tbl_student_opted_course.is_active');
        $this->db->from('tbl_student_opted_course');
        $this->db->join('tbl_student', 'tbl_student.id = tbl_student_opted_course.student_id');
        $this->db->join('tbl_parent', 'tbl_parent.id = tbl_student.parent_id');
        $this->db->join('tbl_course', 'tbl_course.id = tbl_student_opted_course.course_id');

        $this->db->order_by('tbl_student.name', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }
    
    public function update_status($id, $status) {
        $this->db->where('student_id', $id);
        $this->db->update('tbl_student_opted_course', array('is_active' => $status));
    }
}


?>