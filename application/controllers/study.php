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
        
        $this->m_username = $_SESSION["username"]; // get username from session
    }
    
    //--------------------------------------------------------------------------
    
    public function index()
    {
        print $_SESSION["username"];
        $this->viewStudy();
    }   
    
    //--------------------------------------------------------------------------
        
    public function viewStudy()
    {
        $study_id = $this->input->post("study_id");
        
        try
        {
            $this->study_model->setAttributes($this->m_username, self::MODEL_ID);
            $data["study_detail"] = $this->study_model->getStudy($study_id);
            
            $this->scenario_model->setAttributes( self::MODEL_ID, $study_id );
            $data["study_scenarios"] = $this->scenario_model->getStudyScenarios();
            
            $this->load->view("study_detail", $data);
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
            //viewStudy($created_study_id);
            // need to display a view here
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }
        
    }
    
    //--------------------------------------------------------------------------
            
    public function editStudy()
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
            //viewStudy($study_id);
            // need to display a view here
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
            
            // need to load a view here
        }
        catch(Exception $e)
        {
            print $e->getMessage();
            print $e->getTraceAsString();
        }  
        
    }
   
    //--------------------------------------------------------------------------
}
