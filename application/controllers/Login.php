<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class Login extends CI_Controller
  {
     public function index()
     {
        $this->load->view('login/login_header');
        $this->load->view('login/login');
        $this->load->view('login/login_footer.php');
     }
  
  
      public function auth()
	  {
	    if(!empty($_POST))
		{
		    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_password_check');
			
			$this->username=$_POST['username'];
			$this->password=$_POST['password'];	
			$this->load->model('LoginModel');
			$row=$this->LoginModel->select_users($this);	
				
			if($row)
			{				
				
				
				//session begins
					
				$session_array=array('id'=>$row[0]->id,'username'=>$row[0]->username, 'name'=>$row[0]->name);	
				$this->load->library('session');
				$this->session->set_userdata('user',$session_array);

				return redirect(base_url().'Dashboard');
	        }
	        else
	        {
	            $this->session->set_flashdata('error','Wrong Username or Password');
		         return redirect(base_url().'Login');
		    }
			
		}
		else
		{
		    return redirect(base_url().'Login');
			$this->session->set_flashdata('again','Something Went wrong Try again');
	     }   
	}	
	
	public function logout()
	{
		$this->session->unset_userdata('user');
		return redirect(base_url().'Login');
	}
}
   
