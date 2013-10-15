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
        
        $this->m_username = $_SESSION["username"]; // get username from session
    }
    
    //--------------------------------------------------------------------------
    
    public function index()
    {
        searchStudies();
    }        
    
    
    //--------------------------------------------------------------------------
    
    public function searchStudies()
    {
        $question = trim( $this->input->get("question") );
        
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["search_results"] = $this->study_model->searchStudies($question);
            $this->load->view("search_results", $data);
        }
        catch(Exception $e)
        {
            
        }
    }
    
    //--------------------------------------------------------------------------    
}
