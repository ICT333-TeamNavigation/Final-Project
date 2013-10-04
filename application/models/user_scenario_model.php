<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

class User_scenario_model extends CI_Model
{
    private $m_username = null; 
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
    }
    
    //--------------------------------------------------------------------------
    // private CRUD functions
    //--------------------------------------------------------------------------
    
    public function getScenario( $model_id, $study_id )
    {
        
    }   
    
    //--------------------------------------------------------------------------
    
    public function insertScenario( $model_id, $study_id )
    {
        
    }   
    
    //--------------------------------------------------------------------------
    
    public function updateScenario( $model_id, $study_id )
    {
        
    }   
    
    //--------------------------------------------------------------------------
    
    public function deleteScenario( $model_id, $study_id )
    {
        
    }        
    
    
    //--------------------------------------------------------------------------
    // public functions
    //--------------------------------------------------------------------------
       
    public function setUsername( $username )
    {
        $this->data_access_object->checkIsString(COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username);
        
        $this->m_username = $username;
    }
    
    //--------------------------------------------------------------------------
    
}




?>
