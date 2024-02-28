<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller{

	 function __construct(){
	 	parent::__construct();

	 	$this->load->model('item_model');
	 	$this->load->helper('url');
	 }

	 public function index() {
        $this->load->view('items');
    }

     public function get_items() {
        $items = $this->item_model->get_items();
        echo json_encode($items);
    }

    public function add_item() {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'phone' => $this->input->post('phone'),
        );
        $item_id = $this->item_model->add_item($data);
        echo json_encode(array("item_id" => $item_id));
    }

     public function update_item() {
        $id = $this->input->post('edit_id');
        $data = array(
            'name' => $this->input->post('edit_name'),
            'description' => $this->input->post('edit_description'),
            'phone' => $this->input->post('edit_phone'),
        );

        
        $result = $this->item_model->update_item($id, $data);
        if($result) {
        echo json_encode(array("success" => "success"));
	    } else {
	        echo json_encode(array("success" => "error"));
	    }
    }

    public function delete_item() {
        $id = $this->input->post('id');
        $result = $this->item_model->delete_item($id);
        echo json_encode(array("success" => $result));
    }
}

 ?>