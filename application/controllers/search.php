<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search extends CI_Controller 
{
    CONST MODEL_ID = 1;
    private $m_username = null;
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("study_model"); 
        session_start();
        $this->m_username = $_SESSION["username"]; // get username from session
        
    }
    
    //--------------------------------------------------------------------------
    
    public function index()
    {
        print $_SESSION["username"];
        $this->searchStudies();
    }        
    
    
    //--------------------------------------------------------------------------
    
    public function searchStudies()
    {
        $search_str = trim( $this->input->post("searchbox") );
        print "Username: " . $this->m_username . "<br>";
        print "Model_ID: " . self::MODEL_ID . "<br>";
        print "Search string: " . $search_str . "<br>";
        
        
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["search_results"] = $this->study_model->searchStudies($search_str);
            $this->load->view("search_results", $data);
        }
        catch(Exception $e)
        {
            
            print $e->getMessage();
            print $e->getTraceAsString();
        }
    }
    
    //--------------------------------------------------------------------------    
}
