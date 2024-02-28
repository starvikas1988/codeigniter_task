<?php
defined('BASEPATH')  or exit('No direct script access allowed');

/**
 * 
 */
class ProductsController extends CI_Controller
{
	
	public function __construct() {
        parent::__construct();
       
       // $this->load->view('welcome_message');
    }


	function index()
	{
		
		$rows = 5;
		for ($i = 1; $i <= $rows; $i++) {
		    for ($j = 1; $j <= $i; $j++) {
		        echo $j . " ";
		    }
		    echo "<br>";
		}

		$this->load->view('products_message');
	}


}
 ?>