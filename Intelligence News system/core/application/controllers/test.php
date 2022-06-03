<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('test_model');
        }
	public function index() {
		//echo $this->test_model->insert();
            echo '<pre>';
            print_r($this->test_model->select());
            echo '</pre>';
	}
}
