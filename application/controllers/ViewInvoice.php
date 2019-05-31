<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class ViewInvoice extends CI_Controller
  {
        function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('InvoiceModel');
        $this->load->model('Mod_Common');
        if ( ! $this->session->userdata('user'))
        { 
            $this->session->set_flashdata('error','Please Login Again');
            redirect(base_url().'Login');
        }
      }
      
      public function rAlert()
      {
		  if(!is_null(get_cookie('barcode'))) delete_cookie('barcode');
			  if(!is_null(get_cookie('productName'))) delete_cookie('productName');
			  if(!is_null(get_cookie('agency'))) delete_cookie('agency');
			  if(!is_null(get_cookie('units'))) delete_cookie('units');
	      return redirect(base_url().'ViewInvoice/alert');
	  }
      public function index()
      {
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'ViewInvoice/index/';
        $config['total_rows'] = $this->InvoiceModel->countFetch_bill();

        $config['per_page'] = 20;
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

		$data['detail'] = $this->InvoiceModel->fetch_bill($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		        $data['alert_color'] = $this->Mod_Common->alert_color();
		$this->load->view('table/header',$data);  
		$this->load->view('bill/view',$data);  
		$this->load->view('table/footer');  		  
	  }
	
	 public function alert()
     {
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'ViewInvoice/alert/';
        $config['total_rows'] = $this->InvoiceModel->countAlert();

        $config['per_page'] = 20;
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

		$data['detail'] = $this->InvoiceModel->alert($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		$data['agency'] = $this->Mod_Common->selectData($fields='*', 'agency' , $condition=array(), $limit='',$start='');
        $data['alert_color'] = $this->Mod_Common->alert_color();		
		$this->load->view('table/header',$data);  
		$this->load->view('bill/alert',$data);  
		$this->load->view('table/footer');		 
	 }
	 
	public function searchItems()
	  {
		  if(!empty($_POST))
		  {
			  if(!is_null(get_cookie('barcode'))) delete_cookie('barcode');
			  if(!is_null(get_cookie('productName'))) delete_cookie('productName');
			  if(!is_null(get_cookie('agency'))) delete_cookie('agency');
			  if(!is_null(get_cookie('units'))) delete_cookie('units');
			  
			  $this->input->set_cookie('barcode', $_POST['barcode'],'3000');
			  $this->input->set_cookie('productName', $_POST['productName'],'3000');
			  $this->input->set_cookie('agency', $_POST['agency'],'3000');
			  $this->input->set_cookie('units', $_POST['units'],'3000');
			  
			  return redirect(base_url().'ViewInvoice/searchItemsList');
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Please Give Suitable Input.');
				return redirect(base_url().'ViewInvoice/alert');
		  }
	  }
	 
	public function searchItemsList()
     {
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'ViewInvoice/searchItems/';
        $config['total_rows'] = $this->InvoiceModel->countAlert();

        $config['per_page'] = 20;
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

		$data['detail'] = $this->InvoiceModel->alert($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$this->load->model('ItemModel');
		$data['agency']=$this->ItemModel->fetch_agency();
		$data['count'] = $page;
		        $data['alert_color'] = $this->Mod_Common->alert_color();
		$this->load->view('table/header',$data);  
		$this->load->view('bill/alert',$data);  
		$this->load->view('table/footer');		 
	 }
     
     public function searchBil()
	  {
		  if(!empty($_POST))
		  {
			  if(!is_null(get_cookie('bill'))) delete_cookie('bill');
			  if(!is_null(get_cookie('customer'))) delete_cookie('customer');
			  if(!is_null(get_cookie('mobile'))) delete_cookie('mobile');
			  if(!is_null(get_cookie('date'))) delete_cookie('date');
			  
			  $this->input->set_cookie('bill', $_POST['billNo'],'3000');
			  $this->input->set_cookie('customer', $_POST['custName'],'3000');
			  $this->input->set_cookie('mobile', $_POST['mobile'],'3000');
			  $this->input->set_cookie('date', $_POST['date'],'3000');
			  
			  return redirect(base_url().'ViewInvoice/searchBill');
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Please Give Suitable Input.');
				return redirect(base_url().'ViewInvoice/');
		  }
	  }
	  
	 public function searchBill()
      {
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'ViewInvoice/index/';
        $config['total_rows'] = $this->InvoiceModel->countFetch_bill();

        $config['per_page'] = 20;
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

		$data['detail'] = $this->InvoiceModel->fetch_bill($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$data['count'] = $page;
		        $data['alert_color'] = $this->Mod_Common->alert_color();
		$this->load->view('table/header',$data);  
		$this->load->view('bill/view',$data);  
		$this->load->view('table/footer');  		  
	  }
	  
	   public function invoice()
      {
		  if(!is_null(get_cookie('bill'))) delete_cookie('bill');
			  if(!is_null(get_cookie('customer'))) delete_cookie('customer');
			  if(!is_null(get_cookie('mobile'))) delete_cookie('mobile');
			  if(!is_null(get_cookie('date'))) delete_cookie('date');
	      return redirect(base_url().'ViewInvoice/');
	  }
 }
