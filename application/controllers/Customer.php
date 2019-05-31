<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  
  class Customer extends CI_Controller
  {
        function __construct() {
          parent::__construct();
           $this->load->model('CustomerModel');
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
		   $this->load->view('customer/add_customer');
		   $this->load->view('add_item/add_item_footer');     
      }

     public function insert()

     {
	       $customer_name = $this->input->post('customer_name');
	       $mobile = $this->input->post('mobile');
	       $nickname = $this->input->post('nickname');
	       $address = $this->input->post('address');
	       $reference = $this->input->post('reference');
	       $intrest = $this->input->post('intrest');
           
           $check = $this->Mod_Common->count($fields='*' , 'customer' , $condition=array('mobile'=>$mobile));

           if($check > 0)
            {
				 $this->session->set_flashdata('error','Customer already exist');
				 return redirect('Agency');
			}
			else
			{
			  $data = array(			  

			  	'customer_name' => $customer_name,
			  	'mobile' => $mobile,
				'address' => $address,
				'nickname' => $nickname,
				'reference' => $reference,
				'intrest' => $intrest
				);								

				$a = $this->Mod_Common->insertData('customer' , $data);

				if($a)
				{
				   $this->session->set_flashdata('success','Customer Inserted Sucessfully');
				   return redirect('Customer/searchCustomerList');
				}
				else
				{
				  $this->session->set_flashdata('unsuccess','Customer not Inserted Try again');
				  return redirect('Customer');
			    }
			}           		    			
     }

       public function customer_list()
      {
	     	/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model('CustomerModel');
		
		$config['base_url'] = base_url().'Customer/customer_list';
        $config['total_rows'] = $this->CustomerModel->countCustomer();

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

		$data['customer'] = $this->CustomerModel->CustomersList($config['per_page'],$page);
		$data['alert_color'] = $this->Mod_Common->alert_color();
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		
		    $this->load->view('table/header',$data);
            $this->load->view('customer/customer_list',$data);
            $this->load->view('table/footer');  
	  }

/*	  public function bill()

	  {

		   $id = base64_decode($_GET['id']);

           $data['agency']=$this->AgencyModel->agency_name($id);

           $this->load->view('add_item/add_item_header');

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

	  
*/
	  public function payment()
	  {
		   $id = base64_decode($_GET['id']);
		   $data['name'] = base64_decode($_GET['name']);
		   $data['mobile'] = base64_decode($_GET['mobile']);
           $data['bill']=$this->Mod_Common->selectData($fields='*', 'customer_bill' , $condition=array('sale_id'=>$id), $limit='',$start='');           
            $data['alert_color'] = $this->Mod_Common->alert_color();     
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('customer/customer_payment',$data);
           $this->load->view('add_item/add_item_footer');     		  
	  }

	  public function payment_insert()
	  {
		    if(isset($_POST['cheque_no']))
		    {
		    $data = array(			  
		  	 'sale_id' => $_POST['sale_id'],
		   	 'bill_total' => $_POST['bill_total'] - $_POST['payment_d'],
		  	 'payment' => $_POST['payment'],
		  	 'payment_mode' => $_POST['mode'],
    	  	 'cheque_no' => $_POST['cheque_no'],
		  	 'date' => $_POST['date']
			 );
		 }
		 else
		 {
			  $data = array(			  
		  	 'sale_id' => $_POST['sale_id'],
		   	 'bill_total' => $_POST['bill_total'] - $_POST['payment_d'],
		  	 'payment' => $_POST['payment'],
		  	 'payment_mode' => $_POST['mode'],
		  	 'date' => $_POST['date']
			 );
			 }

			 $payment = $_POST['payment_d'] + $_POST['payment'];
			 $data1 = array (			 
			   'payment' => $payment
			 );

		      $this->Mod_Common->insertData('customer_bill_detail', $data);
		      $this->Mod_Common->updateData('customer_bill', $condition=array('sale_id'=>$_POST['sale_id']), $data1);
		      
			 $this->session->set_flashdata('payment','Payment Inserted Sucessfully');			 
			 return redirect('Customer/searchCustomerList');
	  }

	  

	  public function view_details()

	  {

		   $id = base64_decode($_GET['id']);

		   

		 /*	Pagination Technique for View Leads.*/

			$data   = array();

			$this->load->library('pagination');

			$this->load->helper('url');

			//$this->load->library('acl');

		

			$config['base_url'] = base_url().'Customer/view_details/';

			$config['total_rows'] = $this->Mod_Common->count($fields='*' , 'customer_bill' , $condition=array('customer_id'=>$id));

			$config['per_page'] = 40;

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



			$data['bill'] = $this->Mod_Common->selectData($fields='*', 'customer_bill' , $condition=array('customer_id'=>$id), $config['per_page'],$page);

			$data['links']  = $this->pagination->create_links();

			$data['count'] = $page;

			$data['name'] = base64_decode($_GET['name']);
			$data['mobile'] = base64_decode($_GET['mobile']);
			$data['nickname'] = base64_decode($_GET['nickname']);
			$data['address'] = base64_decode($_GET['address']);
			$data['reference'] = base64_decode($_GET['reference']);
			$data['intrest'] = base64_decode($_GET['intrest']);

		   
        $data['alert_color'] = $this->Mod_Common->alert_color();
		   $this->load->view('table/header',$data);

           $this->load->view('customer/customer_bill_details',$data);

           $this->load->view('table/footer');     		  		     

	  }

	  

	  public function payment_history()
	  {
		    $id = base64_decode($_GET['id']);


		   

		   /*	Pagination Technique for View Leads.*/

			$data   = array();

			$this->load->library('pagination');

			$this->load->helper('url');

			//$this->load->library('acl');

		

			$config['base_url'] = base_url().'Customer/payment_history/';

			$config['total_rows'] = $this->Mod_Common->count($fields='*' , 'customer_bill_detail' , $condition=array('sale_id'=>$id) );

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



		   $data['history'] = $this->Mod_Common->selectData($fields='*', 'customer_bill_detail' , $condition=array('sale_id'=>$id), $config['per_page'],$page);

		   $data['links']  = $this->pagination->create_links();

		   $data['count'] = $page;

		   $data['name'] = base64_decode($_GET['name']);
		   $data['mobile'] = base64_decode($_GET['mobile']);
		   			$data['nickname'] = base64_decode($_GET['nickname']);
			$data['address'] = base64_decode($_GET['address']);
			$data['reference'] = base64_decode($_GET['reference']);
			$data['intrest'] = base64_decode($_GET['intrest']);

		   
        $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('table/header',$data);

           $this->load->view('customer/bill_history',$data);

           $this->load->view('table/footer');     		  		    		   		  

	  }

	  

	  public function edit()

	  {

		   $id = base64_decode($_GET['id']);

		   $data['customer']=$this->Mod_Common->selectData($fields='*', 'customer' , $condition=array('customer_id'=>$id), $limit='',$start='');
        $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);

           $this->load->view('customer/edit_customer',$data);

           $this->load->view('add_item/add_item_footer');     		  

	  }

	  

	  public function edit_customer()

	  {

		 $data = array (

		     'customer_name' => $_POST['customer_name'],
		     'mobile' => $_POST['mobile']

		 );
		   $this->Mod_Common->updateData('customer', $condition=array('customer_id'=>$_POST['customer_id']), $data);

           $this->session->set_flashdata('edit','Customer Edited successfully');		   

		   return redirect('Customer/customer_list');		    

	  }

	  

	  public function delete()
	  {
		   $id = base64_decode($_GET['id']);
		   $this->Mod_Common->deleteData('customer', $condition=array('customer_id'=>$id));
           $this->session->set_flashdata('delete','Customer deleted successfully');
           return redirect('Customer/searchCustomerList');  
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


    public function searchCustomers()
	  {
		  if(!empty($_POST))
		  {
			  if(!is_null(get_cookie('cName'))) delete_cookie('cName');
			  if(!is_null(get_cookie('cMobile'))) delete_cookie('cMobile');
			  if(!is_null(get_cookie('cRef'))) delete_cookie('cRef');
			  
			  $this->input->set_cookie('cName', $_POST['name'],'3000');
			  $this->input->set_cookie('cMobile', $_POST['mobile'],'3000');
			  $this->input->set_cookie('cRef', $_POST['ref'],'3000');
			  
			  return redirect(base_url().'Customer/searchCustomerList');
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Please Give Suitable Input.');
				return redirect(base_url().'Customer/searchCustomerList');
		  }
	  }
	  
	  public function searchCustomerList()
       {
           /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model('CustomerModel');
		
		$config['base_url'] = base_url().'Customer/searchCustomerList';
        $config['total_rows'] = $this->CustomerModel->countCustomers();

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

		$data['customer'] = $this->CustomerModel->searchCustomers($config['per_page'],$page);
		$data['alert_color'] = $this->Mod_Common->alert_color();
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		
		    $this->load->view('table/header',$data);
            $this->load->view('customer/customer_list',$data);
            $this->load->view('table/footer');   		      
	   
  }


}

