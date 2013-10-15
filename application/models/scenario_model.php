<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

class Scenario_model extends CI_Model
{
    private $m_model_id = null; 
    private $m_study_id = null; 
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
        $this->load->model('json_builder_model'); 
    }
           
   
    //--------------------------------------------------------------------------
      
    
    public function setAttributes( $model_id, $study_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->m_model_id = $model_id;
        $this->m_study_id = $study_id;
    }
    
       
    //--------------------------------------------------------------------------
    
    // pre:    study_id must be set
    // post:   returns multidimensional array of scenarios belonging to the user study
    //         return false if no data is found
    public function getStudyScenarios()
    {
        if( $this->m_study_id == null )
        {
            throw new Exception(COL_STUDY_ID . " was not set. Need to call setAttributes() first.");
        }
               
        $this->data_access_object->setTableName(TABLE_SCENARIO);
        $where_array[COL_STUDY_ID] = $this->m_study_id;
        
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }   
    
    //--------------------------------------------------------------------------
    
    // returns true if the user scenario exists in the database and false otherwise
    // pre: setUserName must be called beforehand to set the username
    public function isStudyScenario( $scenario_id )
    {
        if( $this->m_study_id == null )
        {
            throw new Exception(COL_STUDY_ID . " was not set. Need to call setAttributes() first.");
        }
        
        $result = $this->getScenario($scenario_id);
        if( ($result !== false) && ($result[COL_STUDY_ID] == $this->m_study_id) )
        {    
            $result = true;
        }
                
        return $result;
    }        
    
    //--------------------------------------------------------------------------
    
    
    // create a new user scenario for the user study
    // the scenario_id is set automatically 
    // and the parms_json is set using a JSON string built using the model tables
    // pre: setUserName must be called beforehand to set the username
    // on success returns the scenario_id of the scenario just created 
    public function createScenario( $name, $description )
    {
        if( $this->m_model_id == null )
        {
            throw new Exception(COL_MODEL_ID . " was not set. Need to call setAttributes() first.");
        }
        
        if( $this->m_study_id == null )
        {
            throw new Exception(COL_STUDY_ID . " was not set. Need to call setAttributes() first.");
        }
        
        $model_id = $this->m_model_id;
        $study_id = $this->m_study_id;
        $scenario_id = $this->getNextScenarioID();
        $parms_json = $this->json_builder_model->getModelJSON( $model_id );
        
        $success = $this->insertScenario($study_id, $scenario_id, 
                                             $name, $description, $parms_json);
        if( $success === false )
        {
            throw new Exception("Failed to create user scenario. Insert into user_scenario table failed.");
        } 
        return $scenario_id;
    }

    
    
     
    //--------------------------------------------------------------------------
    // CRUD functions
    //--------------------------------------------------------------------------
    
    // returns a single user scenario as an array or false if no data is found
    public function getScenario( $scenario_id )
    {
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
        
        $this->data_access_object->setTableName(TABLE_SCENARIO);
        $where_array[COL_SCENARIO_ID] = $scenario_id;
        
        $result = $this->data_access_object->getWhere($where_array);
        if( $result !== false )
        {
            $result = $result[0];  // get first row
        }    
        
        return $result; 
    }   
    
    //--------------------------------------------------------------------------
    
    // insert a single row into the scenario table
    // returns true on success and false on failure
    public function insertScenario( $study_id, $scenario_id, $name, $description, $parms_json )
    {
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_PARMS_JSON , $parms_json);
        $this->data_access_object->checkStringIsValid(COL_PARMS_JSON, $parms_json);
        
        $this->data_access_object->setTableName(TABLE_SCENARIO);
        $insert_array[COL_STUDY_ID]    = $study_id;
        $insert_array[COL_SCENARIO_ID] = $scenario_id;
        $insert_array[COL_NAME]        = $name;
        $insert_array[COL_DESCRIPTION] = $description;
        $insert_array[COL_PARMS_JSON]  = $parms_json;
        
        $result = $this->data_access_object->insert( $insert_array );
        if( $result == 1 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }  
    }   
    
    //--------------------------------------------------------------------------
    
    // update a single row in the user scenario table
    // returns true on success and false on failure
    public function updateScenario( $study_id, $scenario_id, $name, $description, $parms_json )
    {
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_PARMS_JSON , $parms_json);
        $this->data_access_object->checkStringIsValid(COL_PARMS_JSON, $parms_json);
        
        $this->data_access_object->setTableName(TABLE_SCENARIO);
        $where_array[COL_STUDY_ID]     = $study_id;
        $where_array[COL_SCENARIO_ID]  = $scenario_id;
        
        $update_array[COL_NAME]        = $name;
        $update_array[COL_DESCRIPTION] = $description;
        $update_array[COL_PARMS_JSON]  = $parms_json;
               
        $result = $this->data_access_object->updateWhere( $update_array, $where_array );
        if( $result == 1 || $result == 0 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }   
    }   
    
    //--------------------------------------------------------------------------
    
    // delete a single row from the user scenario table
    // returns true on success and false on failure
    public function deleteScenario( $scenario_id )
    {
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
                
        $this->data_access_object->setTableName(TABLE_SCENARIO);
        $where_array[COL_SCENARIO_ID] = $scenario_id;
                       
        $result = $this->data_access_object->deleteWhere( $where_array );
        if( $result == 1 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }  
    }
    
    
    //--------------------------------------------------------------------------
    // End if CRUD functions
    //--------------------------------------------------------------------------
        
    // returns the next scenario_id as an int
    public function getNextScenarioID()
    {
        return $this->data_access_object->getNextID(COL_SCENARIO_ID);
    }
    
    //--------------------------------------------------------------------------

}




?>
