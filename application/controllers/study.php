<?php  if( !defined('BASEPATH') ) exit('No direct script access allowed');

    
class Study extends CI_Controller 
{
    CONST MODEL_ID = 1;
    private $m_username = null;
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("study_model"); 
        $this->load->model("scenario_model"); 
        session_start();
        $this->m_username = $_SESSION["username"]; // get username from session
    }
    
    //--------------------------------------------------------------------------
    
    public function viewCreateStudy()
    {
        $this->load->view("create_study");
    }   
    
    //--------------------------------------------------------------------------
    
    //public function index()
    //{
    //    print $_SESSION["username"];
    //    $this->viewStudy();
    //}   
    
    //--------------------------------------------------------------------------
    
    public function viewStudyDetails()
    {
        $study_id = $this->input->post("study_id");
        $data = $this->getStudyDetails($study_id);
        
        $this->load->view("study_details", $data);
    }        
    
    //--------------------------------------------------------------------------
        
    public function getStudyDetails( $study_id )
    {
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["study_details"] = $this->study_model->getStudy($study_id);
            
            $this->scenario_model->setAttributes( self::MODEL_ID, $study_id );
            $data["study_scenarios"] = $this->scenario_model->getStudyScenarios();
            
            $_SESSION["study_id"] = $study_id; // store study id in session
            
            return($data);
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }
    } 
    
    //--------------------------------------------------------------------------
            
    public function createStudy()
    {
        $name        = trim( $this->input->post("name") );
        $description = trim( $this->input->post("description") );
        $questions   = trim( $this->input->post("questions") );
        $creator     = trim( $this->input->post("creator") );
                
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $created_study_id = $this->study_model->createStudy($name, 
                                                                $description,
                                                                $questions,
                                                                $creator);
            $data = $this->getStudyDetails($created_study_id);
            $this->load->view("study_details", $data);
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }
        
    }
    
    //--------------------------------------------------------------------------
            
    public function saveStudy()
    {
        $study_id    = $this->input->post("study_id");
        $name        = trim( $this->input->post("name") );
        $description = trim( $this->input->post("description") );
        $questions   = trim( $this->input->post("questions") );
        $creator     = trim( $this->input->post("creator") );
        $parm_vis    = trim( $this->input->post("parm_vis") );
        
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $this->study_model->editStudy($study_id,
                                          $name, 
                                          $description,
                                          $questions,
                                          $creator,
                                          $parm_vis);
            
            $data["saved_study_id"] = $study_id;            
            $this->load->view("ajax", $data);
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }
        
    }        
            
    //--------------------------------------------------------------------------
            
    public function removeStudy()
    {        
        $study_id = $this->input->post("study_id");
        
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $this->study_model->removeStudy($study_id);
            
            $data["removed_study_id"] = $study_id;        
            $this->load->view("ajax", $data);
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
            
            $this->load->view("study_list", $data);
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }
    } 
    
    public function node()
    {
        $this->load->view("node_detail");
    } 
}
