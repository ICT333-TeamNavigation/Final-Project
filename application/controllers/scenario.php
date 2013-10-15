<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Scenario extends CI_Controller 
{
    CONST MODEL_ID = 1;
    private $m_username = null;
    private $m_study_id = null;
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenario_model'); 
        
        $this->m_username = $_SESSION["username"]; // get username from session
        $this->m_study_id = $_SESSION["study_id"]; // get study_id from session
    }
    
    //--------------------------------------------------------------------------
           
    public function loadScenario( $scenario_id )
    {
        try
        {
            $this->scenario_model->setAttributes(self::MODEL_ID, $this->m_study_id);
            $load_allowed = $this->scenario_model->isStudyScenario($scenario_id); 
            if( $load_allowed === false )
            {
                throw new Exception(
                "Error loading scenario: $scenario_id. The scenario does not belong to the current study.");
            }    
            
            $scenario = $this->scenario_model->getScenario($scenario_id);
            if( $scenario === false )
            {
                throw new Exception( "Error loading scenario: $scenario_id. The scenario does not exist.");
            }    
            
            $data["scenario_detail"] = $scenario;
            $this->load->view('scenario_detail', $data);
        }
        catch(Exception $e)
        {
            
        }
    }
    
    //--------------------------------------------------------------------------
    
    public function saveScenario( $scenario_id )
    {
        $name        = trim( $this->input->post("name") );
        $description = trim( $this->input->post("description") );
        $parms_json  = trim( $this->input->post("parms_json") );
        
        try
        {
            $this->scenario_model->setAttributes(self::MODEL_ID, $this->m_study_id);
            $scenario_updated = $this->scenario_model->updateScenario($this->m_study_id,
                                                                      $scenario_id, 
                                                                      $name, 
                                                                      $description, 
                                                                      $parms_json );
            if( $scenario_updated === false )
            {
                throw new Exception( "Error saving scenario: $scenario_id. The scenario update failed.");
            }   
            
            loadScenario($scenario_id);
        }
        catch(Exception $e)
        {
            
        }
    }
    
    //--------------------------------------------------------------------------
    
    public function createScenario()
    {
        $name        = trim( $this->input->post("name") );
        $description = trim( $this->input->post("description") );
        
        try
        {
            $this->scenario_model->setAttributes(self::MODEL_ID, $this->m_study_id);
            $created_scenario_id = $this->scenario_model->createScenario($name, $description); 
                                                                
            loadScenario($created_scenario_id);
        }
        catch(Exception $e)
        {
            
        }
        
    }
    
    //--------------------------------------------------------------------------
    
    public function deleteScenario( $scenario_id )
    {
        try
        {
            $this->scenario_model->setAttributes(self::MODEL_ID, $this->m_study_id);
            $delete_allowed = $this->scenario_model->isStudyScenario($scenario_id); 
            if( $delete_allowed === false )
            {
                throw new Exception(
                "Error deleting scenario: $scenario_id. The scenario does not belong to the current study.");
            }    
            
            $scenario_deleted = $this->scenario_model->deleteScenario($scenario_id);
            if( $scenario_deleted === false )
            {
                throw new Exception(
                "Error deleting scenario: $scenario_id. The scenario does not exist so cannot be deleted.");
            }    
            
            // need to load a view here
        }
        catch(Exception $e)
        {
            
        }
               
    }
    
    //--------------------------------------------------------------------------
    
        
}
