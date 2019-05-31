<?php
defined('basepath') or ('No direct script access allowed.');
class Invoice_new extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoicem');
        if ( ! $this->session->userdata('user'))
        { 
            redirect(base_url().'Login');
        }
    }
    
	public function index()
	{
	  for($i=0;$i<$_POST['totalItems'];$i++)
	  {
	      echo $_POST['br'][$i];
	  }
        }

 }
