<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('search_model'); 
    }
    
    public function index()
    {
        $this->load->view('search_results');
    }
    
        
}
