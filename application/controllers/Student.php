<?php
class Student extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('StudentOptedCourseModel');
    }

    public function view() {
        $this->load->library('pagination');
        $searchTerm = $this->input->get('search');
        if ($searchTerm) {
            $total_rows = $this->StudentOptedCourseModel->countFilteredStudents($searchTerm);
        } else {
            $total_rows = $this->StudentOptedCourseModel->countAllStudents();
        }
        $config['base_url'] = base_url('index.php/student/view');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if ($searchTerm) {
            $data['student_opted_courses'] = $this->StudentOptedCourseModel->searchData($searchTerm, $config['per_page'], $page);
        } else {
            $data['student_opted_courses'] = $this->StudentOptedCourseModel->getStudentsPerPage($config['per_page'], $page);
        }
    
        $data['links'] = $this->pagination->create_links();
        $this->load->view('student/view', $data);
    }
    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->StudentOptedCourseModel->update_status($id, $status);
        echo json_encode(array('status' => 'success'));
    }
}

?>