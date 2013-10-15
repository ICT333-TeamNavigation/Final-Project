<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model'); 
    }
    
    public function index()
    {
        $this->load->view('login');
    }
    
    public function authenticate() 
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        
        try
        {
            $this->user_model->setUsername($username);
            $user_exists = $this->user_model->userExists();
            
            $login_data["result"] = "error";
            $login_data["message"] = "Username does not exist";
            
            if( $user_exists )
            {
                log_message('debug', 'user exists');
                // username exists in database
                if( $this->user_model->isCorrectPassword($password))
                {
                    // inputted password is correct
                    $login_data["result"] = "success";
                }
                else
                {
                    $login_data["message"] = "Password is incorrect";
                }    
            }
        }
        catch(Exception $e)
        {
            $login_data["result"] = "error";
            $login_data["message"] = $e->getMessage();
        }
                               
        $login_json = json_encode($login_data);
        $data['ajax'] = $login_json;
        $this->load->view('ajax', $data);
    } 
        
}

/* End of file login.php */
