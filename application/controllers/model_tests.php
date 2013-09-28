<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Model_tests extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_config_model"); 
    }
    
    public function index()
    {
        print "print to screen \n";
        
               
        $user = $this->user_config_model->get_user_config_value( $username, $attribute_name );
        
        //$user = $this->user_config_model->get_user_config( $username, $attribute_name );
        
        //$user = $this->user_config_model->get_user_configs( $username, $attribute_name );
        
    }
    
    public function userConfigModelTest()
    {
        
    }
    
}

// end of file
?>