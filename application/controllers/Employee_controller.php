<?php 

class Employee_controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('form_validation');
	}

	public function index(){
		$data['employee_list_data'] = $this->employee_model->get_employees(); 

		return $this->load->view('employee_list',$data);
	}

	public function add_form()
	{
		//return $this->load->view('employee_list/form');
		$data['items'] = $this->employee_model->get_employees(); 
		return $this->load->view('employee_list1',$data);
	}

	public function add() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('employee_list/form');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
            $this->employee_model->add_item($data);
            
            echo '<li>' . $data['name'] . ' - ' . $data['description'] . '</li>';
           // redirect('employee_controller/add_form');
        }
    }

       public function edit($id) {
        $data['item'] = $this->employee_model->get_item_by_id($id);

        if (empty($data['item'])) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('employee_list/form', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
            $this->employee_model->update_item($id, $data);
            redirect('employee_controller');
        }
    }

    public function delete($id) {
        $this->employee_model->delete_item($id);
        redirect('employee_controller');
    }
}

?>