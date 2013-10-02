<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Model_tests extends CI_Controller 
{
    const STARS = "*************************************************************\n";
    const NEW_LINES = "\n\n";
    
    //---------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_auth_model'); 
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
        print "Testing data_access_object.\n";
        print self::STARS;
        self::authenticateUserTests();
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
    
    public function authenticateUserTests()
    {
        $test_num = 1;
        $test_func = "user_auth_model->userExists( 'test_user' )";
        try
        {
            $results = $this->user_auth_model->userExists( "test_user" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "user_auth_model->userExists( 'executive' )";
        try
        {
            $results = $this->user_auth_model->userExists( "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "user_auth_model->isCorrectPassword( 'executive', 'incorrect_password' )";
        try
        {
            $results = $this->user_auth_model->isCorrectPassword( "executive", "incorrect_password" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        $test_num = 4;
        $test_func = "user_auth_model->isCorrectPassword( 'executive', 'executive' )";
        try
        {
            $results = $this->user_auth_model->isCorrectPassword( "executive", "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
            
              
        
       
    
    }
    
}

// end of file
?>