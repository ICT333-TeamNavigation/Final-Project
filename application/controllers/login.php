<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
         * 
         */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model'); 
    }
    
    public function index()
    {
        $this->load->view('login');
    }
    
    public function auth() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login_data = array("result" => "", "message" => "");
        
        if($username == 'mike' and $password == 'test') {
            $login_data["result"] = "success";
        } else {
            $login_data["result"] = "error";
            $login_data["message"] = "Username or password are incorrect";
        }
        
        $login_data = json_encode($login_data);
        
        $data['ajax'] = $login_data;
        $this->load->view('ajax', $data);
    } 
        
    public function authenticate($username, $password)
    {
        // get record for username
        
        $user = $this->user_model->get_user($username);
        if($user == NULL)
        {
            //fail somehow
        } elseif ($user[0]['password'] == $password) {
            $this->load->view('home');
        
    }
        // if record exists
        
        
    }
}

/* End of file login.php */
