<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->load->view('order_form');
    }

     public function order_list() {
        $data['orders'] = $this->Order_model->get_orders();
        $this->load->view('order_list', $data);
    }

    // public function add_order() {
    //     $data = array(
    //         'category' => $this->input->post('category'),
    //         'product' => $this->input->post('product'),
    //         'order_date' => $this->input->post('orderDate'),
    //         'delivery_date' => $this->input->post('deliveryDate'),
    //         'unit_price' => $this->input->post('unitPrice'),
    //         'quantity' => $this->input->post('quantity'),
    //         'subtotal' => $this->input->post('subtotal')
    //     );
    //     $this->Order_model->add_order($data);
    //     redirect('orders/index');
    // }

    public function add_order() {
        // Retrieve array of form data
        $categories = $this->input->post('category');
        $products = $this->input->post('product');
        $orderDates = $this->input->post('orderDate');
        $deliveryDates = $this->input->post('deliveryDate');
        $unitPrices = $this->input->post('unitPrice');
        $quantities = $this->input->post('quantity');
        $subtotals = $this->input->post('subtotal');

        // Loop through each set of form data and insert into database
        for ($i = 0; $i < count($categories); $i++) {
            $data = array(
                'category' => $categories[$i],
                'product' => $products[$i],
                'order_date' => $orderDates[$i],
                'delivery_date' => $deliveryDates[$i],
                'unit_price' => $unitPrices[$i],
                'quantity' => $quantities[$i],
                'subtotal' => $subtotals[$i]
            );

            // Process $data here (e.g., validation, conversion)

            $this->Order_model->add_order($data);
        }

        redirect('orders/index');
    }

}
