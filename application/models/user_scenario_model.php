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
    // CRUD functions
    //--------------------------------------------------------------------------
    
    // returns a single user scenario as an array or false if no data is found
    public function getUserScenario( $model_id, $study_id, $scenario_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
        
        $this->data_access_object->setTableName(TABLE_USER_SCENARIO);
        $where_array[COL_USERNAME]    = $this->m_username;
        $where_array[COL_MODEL_ID]    = $model_id;
        $where_array[COL_STUDY_ID]    = $study_id;
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
    public function insertUserScenario( $model_id, $study_id, $scenario_id, $name, $description, $parms_json )
    {
         if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
           
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
        
        $this->data_access_object->setTableName(TABLE_USER_SCENARIO);
        $insert_array[COL_USERNAME]    = $this->m_username;
        $insert_array[COL_MODEL_ID]    = $model_id;
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
    public function updateUserScenario( $model_id, $study_id, $scenario_id, $name, $description, $parms_json )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
           
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
        
        $this->data_access_object->setTableName(TABLE_USER_SCENARIO);
        $where_array[COL_USERNAME]     = $this->m_username;
        $where_array[COL_MODEL_ID]     = $model_id;
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
    public function deleteUserScenario( $model_id, $study_id, $scenario_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
           
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsInt(COL_SCENARIO_ID, $scenario_id );
        $this->data_access_object->checkNumberIsValid(COL_SCENARIO_ID, $scenario_id );
                
        $this->data_access_object->setTableName(TABLE_USER_SCENARIO);
        $where_array[COL_USERNAME]    = $this->m_username;
        $where_array[COL_MODEL_ID]    = $model_id;
        $where_array[COL_STUDY_ID]    = $study_id;
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
       
    public function setUsername( $username )
    {
        $this->data_access_object->checkIsString(COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username);
        
        $this->m_username = $username;
    }
    
    //--------------------------------------------------------------------------
    
    // pre:    username must be set
    // post:   returns multidimensional array of scenarios belonging to the user study
    //         return false if no data is found
    public function getUserStudyScenarios( $model_id, $study_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        }
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
           
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_USER_SCENARIO);
        $where_array[COL_USERNAME] = $this->m_username;
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }   
    
    //--------------------------------------------------------------------------
    
    // returns true if the user scenario exists in the database and false otherwise
    // pre: setUserName must be called beforehand to set the username
    public function userScenarioExists( $model_id, $study_id, $scenario_id )
    {
        $result = $this->getUserScenario($model_id, $study_id, $scenario_id);
       
        $user_scenario_exists = false;
        if( $result !== false )
        {
            $user_scenario_exists = true;
        }    
        return $user_scenario_exists;
    }        
    
    //--------------------------------------------------------------------------
    
    
    // create a new user scenario for the user study
    // the scenario_id is set automatically 
    // and the parms_json is set using a JSON string built using the model tables
    // pre: setUserName must be called beforehand to set the username
    public function createUserScenario( $model_id, $study_id, $name, $description )
    {
        $scenario_id = $this->getNextScenarioID();
        //$parms_json = $this->getModelJSON( $model_id );
        $success = $this->insertUserScenario($model_id, $study_id, $scenario_id, 
                                             $name, $description, $parms_json);
        if( $success === false )
        {
            throw new Exception("Failed to create user scenario. Insert into user_scenario table failed.");
        } 
    }
    
    //--------------------------------------------------------------------------
    
    
    // returns a JSON string that represents the model structure for the model
    // identified by model_id
    public function getModelJSON( $model_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $json_str = "\"nodes\": [ ";
        
        // get all nodes for this model from the node table
        $this->data_access_object->setTableName(TABLE_NODE);
        $where_array[COL_MODEL_ID] = $model_id;
        $nodes = $this->data_access_object->getWhere($where_array);
        if( $nodes === false )
        {
            throw new Exception("Failed to get model JSON. Unable to get node data from node table.");
        }  
        
        $i = 0;
        $last_node_index = count($nodes) - 1;
        foreach( $nodes as $node )
        {
            $node_json = $this->getNodeJSON($node);
            if( $node_json === false )
            {
                throw new Exception("Failed to get node JSON. Unable to build node 
                                     json using parameter and link tables.");    
            }    
            $json .= $node_json;
            if( $i != $last_node_index  )
            {
                $json .= ",\n"; // add the ',' to separate the node json objects
            }
            $i++;
        }
        $json .= "]";
    }
    
    
    //--------------------------------------------------------------------------
    
    
    public function getNodeJSON( $node_array )
    {
        $this->data_access_object->checkIsArray($node_array);
        $model_id = $node_array[COL_MODEL_ID];
        $node_id  = $node_array[COL_NODE_ID];
        $name     = $node_array[COL_NAME];
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->checkIsInt(COL_NODE_ID, $node_id );
        $this->data_access_object->checkNumberIsValid(COL_NODE_ID, $node_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        
        $node_json  = "{ \"node_id\"    : $node_id,";
        $node_json .= "  \"name\"       : \"$name\",";
        $node_json .= "  \"parameters\" : [ ";
        
        // getNodeParameters
        $this->data_access_object->setTableName(TABLE_PARAMETER);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_NODE_ID]  = $node_id;
        $node_parameters = $this->data_access_object->getWhere($where_array);
        if( $node_parameters === false )
        {
            throw new Exception("Failed to get node JSON. Unable to get parameter data from parameter table.");
        }
        
        $i = 0;
        $last_parm_index = count($node_parameters) - 1;        
        foreach( $node_parameters as $node_parm )
        {
            $parm_json = $this->getNodeParameterJSON($node_parm);
            $node_json .= $parm_json;
            if( $i != $last_parm_index  )
            {
                $node_json .= ",\n"; // add the ',' to separate the node json objects
            }
            $i++;
        }
        $node_json .= "],";  // close parameters json array
        $node_json .= "\"links\" : [";
         
        // getNodeLinks
        
        
        
        $node_json .= "}";
        
    }
    
    //--------------------------------------------------------------------------
            
     "nodes": 
    [
        {
            "node_id"      :  (number),              
            "name"         :  (string),       
            "parameters"   :  
            [
                {
                    "parm_name" :     (string) "parm1",
                    "current_value":  (number),
                    "min_value":      (number),
                    "max_value":      (number),
                    "visible"  :      (boolean)
                },
                {
                    "parm_name" :     (string) "parm2",
                    "current_value":  (number),
                    # ...etc
                }
            ],
            "links": 
            [
                1,
               (number),
               (number)          
            ]
        },
        {
            "node_id"      :  (number),    
            # ...etc
        }
    ]
    //--------------------------------------------------------------------------

}




?>
