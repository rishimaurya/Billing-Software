<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class Agency extends CI_Controller
  {
        function __construct() {
        parent::__construct();
        $this->load->model('AgencyModel');
        $this->load->model('Mod_Common');
        $this->load->helper('cookie');
        if ( ! $this->session->userdata('user'))
        { 
            $this->session->set_flashdata('error','Please Login Again');
            redirect(base_url().'Login');
        }
    }

     
      public function index()
      {
		   $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('agency/add_agency');
           $this->load->view('add_item/add_item_footer');     
     }
     
     public function insert()
     {
		 
	       $agency_name = $this->input->post('agency_name');
	       $mobile = $this->input->post('mobile');
	       $address = $this->input->post('address');
	       $owner = $this->input->post('owner');
           $check = $this->AgencyModel->check_duplicate($agency_name);
           if($check > 0)
            {
				 $this->session->set_flashdata('error','Agency already exist');
				 return redirect('Agency');
			}
			else
			{
			  $data = array(			  
			  	'agency_name' => $agency_name,
			  	'address' => $address,
			  	'mobile' => $mobile,
			  	'owner' => $owner
				);								
				
				$a = $this->AgencyModel->form_insert($data);
				if($a)
				{
				   $this->session->set_flashdata('success','Agency Inserted Sucessfully');
				   return redirect('Agency/agency_list');
				}
				else
				{
				  $this->session->set_flashdata('unsuccess','Item not Inserted Try again');
				  return redirect('Agency');
			    }
			}           		    			 
	    
     }
     
     public function searchAgency()
	  {
		  if(!empty($_POST))
		  {
			  if(!is_null(get_cookie('aName'))) delete_cookie('aName');
			  if(!is_null(get_cookie('aMobile'))) delete_cookie('aMobile');
			  if(!is_null(get_cookie('aOwner'))) delete_cookie('aOwner');
			  
			  $this->input->set_cookie('aName', $_POST['name'],'3000');
			  $this->input->set_cookie('aMobile', $_POST['mobile'],'3000');
			   $this->input->set_cookie('aOwner', $_POST['owner'],'3000');
			  
			  return redirect(base_url().'Agency/searchAgencyList');
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Please Give Suitable Input.');
				return redirect(base_url().'Agency/agency_list');
		  }
	  }
	  
       public function agency_list()
      {
	     	$data['agency'] = $this->AgencyModel->fetch_agency();
                  $data['alert_color'] = $this->Mod_Common->alert_color();  
            $this->load->view('table/header',$data);
            $this->load->view('agency/agency_list',$data);
            $this->load->view('table/footer');   
	  }
	  
	  public function searchAgencyList()
       {
           /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model('AgencyModel');
		
		$config['base_url'] = base_url().'Agency/searchAgencyList';
        $config['total_rows'] = $this->AgencyModel->countAgency();

        $config['per_page'] = 30;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['agency'] = $this->AgencyModel->searchAgency($config['per_page'],$page);
		$data['alert_color'] = $this->Mod_Common->alert_color();
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		
		    $this->load->view('table/header',$data);
            $this->load->view('agency/agency_list',$data);
            $this->load->view('table/footer');    		      
	   
  }
  
	  public function bill()
	  {
		   $id = base64_decode($_GET['id']);
           $data['agency']=$this->AgencyModel->agency_name($id);
                   $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('agency/agency_bill',$data);
           $this->load->view('add_item/add_item_footer');     		  
	  }
	  
	  public function bill_insert()
	  {
		    $num = $this->AgencyModel->check_bill($_POST['bill_no']);
		    if($num > 0)
		    {
			   $this->session->set_flashdata('already','Bill number already exist in database'); 	
			   return redirect('Agency/agency_list');
			}			  
            $data = array(			  
		  	'agency_id' => $_POST['agency_id'],
		  	'bill_no' => $_POST['bill_no'],
		   	'bill_amount' => $_POST['bill_amount'],
		  	'payment' => $_POST['payment'],
		  	'payment_remaining' => $_POST['bill_amount'] - $_POST['payment'],
		  	'date' => $_POST['date']
			 );								
		if(isset($_POST['cheque_number']))
		{
		    $data1 = array(			  
		  	'agency_id' => $_POST['agency_id'],
		  	'bill_no' => $_POST['bill_no'],
		   	'bill_amount' => $_POST['bill_amount'],
		  	'payment' => $_POST['payment'],
		  	'payment_mode' => $_POST['mode'],
		  	'cheque_number' => $_POST['cheque_number'],
		  	'date' => $_POST['date']
			 );	
		}	
		else
		{
			$data1 = array(			  
		  	'agency_id' => $_POST['agency_id'],
		  	'bill_no' => $_POST['bill_no'],
		   	'bill_amount' => $_POST['bill_amount'],
		  	'payment' => $_POST['payment'],
		  	'payment_mode' => $_POST['mode'],
		  	'date' => $_POST['date']
			 );	
		} 	
	    	$a = $this->AgencyModel->bill_insert($data,$data1);
			if($a)
			{
			   $this->session->set_flashdata('success','Bill Inserted Sucessfully');
			   return redirect('Agency/agency_list');
			}
			else
			{
			   $this->session->set_flashdata('unsuccess','Item not Inserted Try again');
			   return redirect('Agency');
			}		  
	  }
	  
	  public function payment()
	  {
		   $id = base64_decode($_GET['id']);
		   $bill = base64_decode($_GET['bill_no']);
		   $data['agency'] = base64_decode($_GET['agency']);
           $data['bill']=$this->AgencyModel->bill_detail($id,$bill);           
               $data['alert_color'] = $this->Mod_Common->alert_color();    
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('agency/agency_payment',$data);
           $this->load->view('add_item/add_item_footer');     		  
	  }
	  
	  public function payment_insert()
	  {
		    if(isset($_POST['cheque_number']))
		    {
		    $data = array(			  
		  	 'agency_id' => $_POST['agency_id'],
		  	 'bill_no' => $_POST['bill_no'],
		   	 'bill_amount' => $_POST['remaining'],
		  	 'payment' => $_POST['payment'],
		  	 'payment_mode' => $_POST['mode'],
		  	'cheque_number' => $_POST['cheque_number'],
		  	 'date' => $_POST['date']
			 );
		 }
		 else
		 {
			  $data = array(			  
		  	 'agency_id' => $_POST['agency_id'],
		  	 'bill_no' => $_POST['bill_no'],
		   	 'bill_amount' => $_POST['remaining'],
		  	 'payment' => $_POST['payment'],
		  	 'payment_mode' => $_POST['mode'],
		  	 'date' => $_POST['date']
			 );
			 }
			 $remaining = $_POST['bill_amount'] - $_POST['remaining'];
			 $payment = $remaining + $_POST['payment'];
			 
			 $data1 = array (			 
			   'payment' => $payment,
			   'payment_remaining' => $_POST['remaining'] - $_POST['payment']
			 );
			 
			 $this->AgencyModel->add_payment($data,$data1,$_POST['agency_id'],$_POST['bill_no']);
			 $this->session->set_flashdata('payment','Payment Inserted Sucessfully');			 
			 return redirect('Agency/agency_list');
	  }
	  
	  public function view_details()
	  {
		   $id = base64_decode($_GET['id']);
		   
		 /*	Pagination Technique for View Leads.*/
			$data   = array();
			$this->load->library('pagination');
			$this->load->helper('url');
			//$this->load->library('acl');
		
			$config['base_url'] = base_url().'Agency/view_details/';
			$config['total_rows'] = $this->AgencyModel->countBill_details($id);

			$config['per_page'] = 20;
			$config['uri_segment'] = 3;
			$config['suffix'] ='';
			$config['reuse_query_string'] = true;
        
		//Styling Link for Pagination. 
        
			$config['full_tag_open']    = "<ul class='pagination'>";
			$config['full_tag_close']   = "</ul>";
			$config['num_tag_open']     = "<li>";
			$config['num_tag_close']    = "</li>";
			$config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open']    = "<li>";
			$config['next_tagl_close']  = "</li>";
			$config['prev_tag_open']    = "<li>";
			$config['prev_tagl_close']  = "</li>";
			$config['first_tag_open']   = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open']    = "<li>";
			$config['last_tagl_close']  = "</li>";
			$this->pagination->initialize($config); 
        
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			$data['bill'] = $this->AgencyModel->bill_details($config['per_page'],$page,$id);
			$data['links']  = $this->pagination->create_links();
			$data['count'] = $page;
			$data['agency'] = base64_decode($_GET['agency']);
			$data['mobile'] = base64_decode($_GET['mobile']);
			$data['address'] = base64_decode($_GET['address']);
			$data['owner'] = base64_decode($_GET['owner']);
		   
		           $data['alert_color'] = $this->Mod_Common->alert_color();
		   $this->load->view('table/header',$data);
           $this->load->view('agency/agency_bill_details',$data);
           $this->load->view('table/footer');     		  		     
	  }
	  
	  public function payment_history()
	  {
		   $id = base64_decode($_GET['id']);
		   $bill_no = base64_decode($_GET['bill_no']);
		   
		   /*	Pagination Technique for View Leads.*/
			$data   = array();
			$this->load->library('pagination');
			$this->load->helper('url');
			//$this->load->library('acl');
		
			$config['base_url'] = base_url().'Agency/payment_history/';
			$config['total_rows'] = $this->AgencyModel->countBill_history($id,$bill_no);

			$config['per_page'] = 20;
			$config['uri_segment'] = 3;
			$config['suffix'] ='';
			$config['reuse_query_string'] = true;
        
		//Styling Link for Pagination. 
        
			$config['full_tag_open']    = "<ul class='pagination'>";
			$config['full_tag_close']   = "</ul>";
			$config['num_tag_open']     = "<li>";
			$config['num_tag_close']    = "</li>";
			$config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open']    = "<li>";
			$config['next_tagl_close']  = "</li>";
			$config['prev_tag_open']    = "<li>";
			$config['prev_tagl_close']  = "</li>";
			$config['first_tag_open']   = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open']    = "<li>";
			$config['last_tagl_close']  = "</li>";
			$this->pagination->initialize($config); 
        
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		   $data['history'] = $this->AgencyModel->bill_history($config['per_page'],$page,$id,$bill_no);
		   $data['links']  = $this->pagination->create_links();
		   $data['count'] = $page;
		   
		   $data['agency'] = base64_decode($_GET['agency']);
                   $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('table/header',$data);
           $this->load->view('agency/bill_history',$data);
           $this->load->view('table/footer');     		  		    		   		  
	  }
	  
	  public function edit()
	  {
		   $id = base64_decode($_GET['id']);
		   $data['agency']=$this->AgencyModel->agency_name($id);
             $data['alert_color'] = $this->Mod_Common->alert_color();      
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('agency/edit_agency',$data);
           $this->load->view('add_item/add_item_footer');     		  
	  }
	  
	  public function edit_agency()
	  {
		 $data = array (
		     'agency_name' => $_POST['agency_name']
		 );
		 
		   $this->AgencyModel->agency_update($_POST['agency_id'],$data);
           $this->session->set_flashdata('edit','Agency Edited successfully');		   
		   return redirect('Agency/agency_list');		    
	  }
	  
	  	  public function delete()
	  {
		   $id = base64_decode($_GET['id']);
		   
		   $this->AgencyModel->delete_agency($id);
           $this->session->set_flashdata('delete','Agency deleted successfully');
           return redirect('Agency/agency_list');  
	  }
	    public function bill_edit()
	  {
		   $id = base64_decode($_GET['id']);
		   $bill = base64_decode($_GET['bill_no']);
		   $data['agency'] = base64_decode($_GET['agency']);
           $data['bill']=$this->AgencyModel->bill_detail($id,$bill);           
           $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('agency/bill_edit',$data);
           $this->load->view('add_item/add_item_footer');     		  
	  }

	  public function bill_update()
	  {
		  if($_POST['prev_bill'] != $_POST['bill_no'])
		  {
		       $this->AgencyModel->change_billno($_POST['agency_id'],$_POST['prev_bill'],$_POST['bill_no']);
		  }
           
          if($_POST['prev_bill_amount'] != $_POST['bill_amount'])
		  {
			  if($_POST['prev_bill_amount'] < $_POST['bill_amount'])
		       {
		         $add = $_POST['bill_amount'] - $_POST['prev_bill_amount'];
		         $this->AgencyModel->change_billamount($_POST['agency_id'],$_POST['prev_bill_amount'],$_POST['bill_amount']);
		       }
		       
		  }            
		  
         $this->AgencyModel->changeDate($_POST['agency_id'],$_POST['bill_no'],$_POST['prevdate'],$_POST['date']);
           
            $this->session->set_flashdata('payment','Bill Updated Sucessfully');			 
			 return redirect('Agency/agency_list');
	  }


}
