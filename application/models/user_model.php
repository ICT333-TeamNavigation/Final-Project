<?php
    class User_model extends CI_Model {
    
    var $first_name   = '';
    var $last_name = '';
    var $username = '';
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //
        $this->load->database();
    }

    function get_user($username)
    {   
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->result_array();
    }
    
    function get_users()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }
        
    
}
?>