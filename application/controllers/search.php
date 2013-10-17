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
        
    public function searchStudies()
    {
        $search_str = trim( $this->input->post("search_str") );
             
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["study_list"] = $this->study_model->searchStudies($search_str);
            
            $data["title"] = "Search Results";
            $this->load->view("study_list", $data);
        }
        catch(Exception $e)
        {
            
            print $e->getMessage();
            print $e->getTraceAsString();
        }
    }
    
    //--------------------------------------------------------------------------
    
    public function loadUserStudies()
    {
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["study_list"] = $this->study_model->getUserStudies();
            
            $data["title"] = "User Studies";
            $this->load->view("study_list", $data);
        }
        catch(Exception $e)
        {
            
            print $e->getMessage();
            print $e->getTraceAsString();
        }
    }        
    
    //--------------------------------------------------------------------------    
}
