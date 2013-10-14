<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Json_builder_model extends CI_Model
{
            
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
    }
    
    //--------------------------------------------------------------------------
    
    
    // queries the node table to get all the nodes for a model
    // return a multidimentional array or false if no data is found
    public function getModelNodes( $model_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );

        $this->data_access_object->setTableName(TABLE_NODE);
        $where_array[COL_MODEL_ID] = $model_id;
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }        
    
    //--------------------------------------------------------------------------
    
    
    // queries the parameters table to get all the parameters for a node
    // return a multidimentional array or false if no data is found
    public function getNodeParameters( $model_id, $node_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->checkIsInt(COL_NODE_ID, $node_id );
        $this->data_access_object->checkNumberIsValid(COL_NODE_ID, $node_id );
        
        $this->data_access_object->setTableName(TABLE_PARAMETER);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_NODE_ID]  = $node_id;
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }  
    
    
    //--------------------------------------------------------------------------
    
    
    // queries the links table to get all the links for a node
    // return a multidimentional array or false if no data is found
    public function getNodeLinks( $model_id, $node_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->checkIsInt(COL_NODE_ID, $node_id );
        $this->data_access_object->checkNumberIsValid(COL_NODE_ID, $node_id );
        
        $this->data_access_object->setTableName(TABLE_LINK);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_NODE_ID]  = $node_id;
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    } 
    
    //--------------------------------------------------------------------------
    
        
    // returns a JSON string that represents the model structure for the model
    // identified by model_id
    public function getModelJSON( $model_id )
    {
        $nodes = $this->getModelNodes($model_id);
        if( $nodes === false )
        {
            throw new Exception("Failed to get model JSON. Unable to get node data from node table.");
        }  
                
        $json_str = "\"nodes\": [ \n";
                  
        $i = 0;
        $last_node_index = count($nodes) - 1;
        
        foreach( $nodes as $node_row )
        {
            $model_id = $node_row[COL_MODEL_ID];
            $node_id  = $node_row[COL_NODE_ID];
            $name     = $node_row[COL_NAME];
            
            $node_json = $this->getNodeJSON($model_id, $node_id, $name);
            if( $node_json === false )
            {
                throw new Exception("Failed to get node JSON. Unable to build node 
                                     json using parameter and link tables.");    
            }    
            $json_str .= $node_json;
            if( $i != $last_node_index  )
            {
                $json_str .= ",\n"; // add the ',' to separate the node json objects
            }
            $i++;
        }
        
        $json_str .= "]";
        
        return $json_str;
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // returns the json for a single node
    public function getNodeJSON( $model_id, $node_id, $name )
    {
        $node_parameters = $this->getNodeParameters( $model_id, $node_id );   
        if( $node_parameters === false )
        {
            $msg  = "Failed to get node JSON. Unable to get parameter data from parameter table.\n";
            $msg .= "model_id: " . $model_id . "\n";
            $msg .= "node_id : " . $node_id  . "\n";
            throw new Exception($msg);
        }
        
        $node_links = $this->getNodeLinks( $model_id, $node_id );   
        if( $node_links === false )
        {
            $msg  = "Failed to get node JSON. Unable to get links data from links table.\n";
            $msg .= "model_id: " . $model_id . "\n";
            $msg .= "node_id:  " . $node_id  . "\n";
            throw new Exception($msg);
        }    
        
                
        $node_json  = "{\n  \"node_id\"          : $node_id,";
        $node_json .=  "\n  \"name\"             : \"$name\",";
        $node_json .=  "\n  \"parameters\"       : [\n ";
                   
        
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
        $node_json .= "\n],\n";  // close parameters json array
        $node_json .= "\"links\" : [ ";
         
        $i = 0;
        $last_link_index = count($node_links) - 1; 
        foreach( $node_links as $link )
        {
            $node_json .= $link[COL_LINK_NODE_ID];
            if( $i != $last_link_index  )
            {
                $node_json .= ", "; // add the ',' to separate the node json objects
            }
            $i++;
        }    
        
        $node_json .= " ]\n}\n";
        
        return $node_json;
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // returns the json for a single parameter
    public function getNodeParameterJSON($node_parm)
    {
        $this->data_access_object->checkIsArray($node_parm);
        
        $visible = "false";
        if($node_parm[COL_VISIBLE_DEFAULT])
        {
            $visible = "true";
        }    
        
        $parm_json = " {";
        $parm_json .= "\n     \"parm_name\"     : \"". $node_parm[COL_PARM_NAME] . "\"";
        $parm_json .= "\n     \"current_value\" : "  . $node_parm[COL_DEFAULT_VALUE];
        $parm_json .= "\n     \"min_value\"     : "  . $node_parm[COL_MIN_VALUE];
        $parm_json .= "\n     \"max_value\"     : "  . $node_parm[COL_MAX_VALUE];
        $parm_json .= "\n     \"visible\"       : "  . $visible;
        $parm_json .= "\n     \"control_type\"  : \"". $node_parm[COL_CONTROL_TYPE] . "\"";
        $parm_json .= "\n  }";
        
        return $parm_json;
    }
    
    
    //--------------------------------------------------------------------------
}

?>
