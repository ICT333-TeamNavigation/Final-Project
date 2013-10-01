<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Model_tests extends CI_Controller 
{
    const STARS = "*************************************************************\n";
    const NEW_LINES = "\n\n";
    
    //---------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_config_dao"); 
    }
    
    //---------------------------------------------------------------------------
    
    public function index()
    {
        print "<pre>\n";
        print self::STARS; 
        print self::STARS;
        print "Beginning model unit tests.\n";
        print self::STARS; 
        print self::STARS; 
        print self::NEW_LINES;
        
        print self::STARS;
        print "Testing user_config_model.\n";
        print self::STARS;
        self::userConfigModelTests();
        print self::NEW_LINES;
        
               
        print "</pre>\n";
    }
    
    //---------------------------------------------------------------------------
    
    private function printTestResults( $test_number, $test_function, $results )
    {
        print "Test $test_number: $test_function \n";
        print "Results: \n";
        var_dump($results);
        print self::NEW_LINES;
    }
    
    //---------------------------------------------------------------------------
    
    public function userConfigModelTests()
    {
        
        $test_num = 1;
        $test_func = "user_config_model->getRow( 1, 'test_string' )";
        try
        {
            $results = $this->user_config_dao->getRow( 1, "test_string" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
            
        
       
        $test_num = 2;
        $test_func = "user_config_model->getRow( 'test_string', 1 )";
        try
        {
            $results = $this->user_config_dao->getRow( "test_string",  1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        
        $test_num = 3;
        $test_func = "user_config_model->getRow( '', 'test_string' )";
        try
        {
            $results = $this->user_config_dao->getRow( "", "test_string" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        
        $test_num = 4;
        $test_func = "user_config_model->getRow( 'test_string', '' )";
        try
        {
            $results = $this->user_config_dao->getRow( "test_string", "" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        
        $test_num = 5;
        $test_func = "user_config_model->getRow( 'test_string', 'test_string' )";
        try
        {
            $results = $this->user_config_dao->getRow( "test_string", "test_string" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        $test_num = 6;
        $test_func = "user_config_model->insertRow('executive', 'test_att', 'test_value)";
        try
        {
            $results = $this->user_config_dao->insertRow("executive", "test_att", "test_value");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        $test_num = 7;
        $test_func = "user_config_model->getRow( 'executive', 'test_att' )";
        try
        {
            $results = $this->user_config_dao->getRow( "executive", "test_att" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        
        $test_num = 8;
        $test_func = "user_config_model->updateRow( 'executive', 'test_att', 'updated_value' )";
        try
        {
            $results = $this->user_config_dao->updateRow( "executive", "test_att", "updated_value" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
               
        $test_num = 9;
        $test_func = "user_config_model->getAllRows()";
        try
        {
            $results = $this->user_config_dao->getAllRows();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
        
        
        $test_num = 10;
        $test_func = "user_config_model->deleteRow()";
        try
        {
            $results = $this->user_config_dao->deleteRow("executive", "test_att" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results );
                  
        
       
    
    }
    
}

// end of file
?>