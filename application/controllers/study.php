<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Study extends CI_Controller {

	/**
         * 
         */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('study_model'); 
    }
    
    public function index()
    {
        $this->load->view('study_detail');
    }
    
        
}

/* End of file login.php */