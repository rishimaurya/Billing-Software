<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class Add_item extends CI_Controller
  {
        function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('ItemModel');
        $this->load->model('Mod_Common');
        if ( ! $this->session->userdata('user'))
        { 
            $this->session->set_flashdata('error','Please Login Again');
            redirect(base_url().'Login');
        }
    }

     
      public function index()
      {
		   $data['agency']=$this->ItemModel->fetch_agency();
        $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('add_item/add_item',$data);
           $this->load->view('add_item/add_item_footer');     
     }
     
     public function insert()
     {
	       $barcode = $this->input->post('barcode');
           $check = $this->ItemModel->check_duplicate($barcode);
           if($check > 0)
            {
				 $this->session->set_flashdata('error','Item already exist with this barcode');
				 return redirect('Add_item');
			}
			else
			{
				
			  $data = array(			  
			  	'barcode_id' => $barcode,
			  	'description' => $this->input->post('description'),
				'category' => $this->input->post('category'),			  	
				'units' => $this->input->post('units'),
				'mrp' => $this->input->post('mrp'),
                'selling_price' => $this->input->post('min_price'),
				'cost_price' => $this->input->post('cp'),
				'low_units' => $this->input->post('alert'),
				'not_sale_date' => DATE('Y-m-d')
				);								
				
				$a = $this->ItemModel->form_insert($data);
				if($a)
				{
				   $this->session->set_flashdata('success','Item Inserted Sucessfully');
				   return redirect('Add_item');
				}
				else
				{
				  $this->session->set_flashdata('unsuccess','Item not Inserted Try again');
				  return redirect('Add_item');
			    }
			}           		    			 
	    
     }
     
     public function itemList()
     {
		 if(!is_null(get_cookie('barcode'))) delete_cookie('barcode');
			  if(!is_null(get_cookie('productName'))) delete_cookie('productName');
			  if(!is_null(get_cookie('agency'))) delete_cookie('agency');
			  if(!is_null(get_cookie('units'))) delete_cookie('units');
	      return redirect(base_url().'Add_item/item_list');
	}
     public function item_list()
     {
		      /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'Add_item/item_list/';
        $config['total_rows'] = $this->ItemModel->countProducts();

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

		$data['items'] = $this->ItemModel->fetch_items($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$data['agency']=$this->ItemModel->fetch_agency();
		$data['count'] = $page;
		
		        $data['alert_color'] = $this->Mod_Common->alert_color();
		
            $this->load->view('table/header',$data);
            $this->load->view('add_item/item_list',$data);
            $this->load->view('table/footer');
	     
	 }
	 
	 public function edit_item()
	 {
		$barcode= base64_decode($_GET['barcode']);
		$data['items'] = $this->ItemModel->fetch_selected_item($barcode);
    	$data['agency']=$this->ItemModel->fetch_agency();
               $data['alert_color'] = $this->Mod_Common->alert_color();
        $this->load->view('add_item/add_item_header',$data);
        $this->load->view('add_item/edit_item',$data);
        $this->load->view('add_item/add_item_footer');     
	 }
	 
	      public function update()
        {				
			  $data = array(			  
			  	'barcode_id' => $this->input->post('barcode'),
			  	'description' => $this->input->post('description'),
				'category' => $this->input->post('category'),
				'units' => $this->input->post('units'),
				'mrp' => $this->input->post('mrp'),
				'cost_price' => $this->input->post('cp'),
				'selling_price' => $this->input->post('selling_price'),
				'low_units' => $this->input->post('alert')
				);								
				$bar = $this->input->post('barcode');
				$a = $this->ItemModel->form_update($data,$bar);
				if($a)
				{
				   $this->session->set_flashdata('success','Item Updated Sucessfully');
				   return redirect('Add_item/item_list');
				}
				else
				{
				  $this->session->set_flashdata('unsuccess','Item not Updated Try again');
		           return redirect('Add_item/item_list');
		        } 
		}           		    			 
	    
       public function add_stock()
       {
		           $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('add_item/add_item_header',$data);
           $this->load->view('add_item/add_stock');
           $this->load->view('add_item/add_item_footer');		      
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
			  
			  return redirect(base_url().'Add_item/searchItemsList');
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Please Give Suitable Input.');
				return redirect(base_url().'Add_item/item_list');
		  }
	  }
	  
	  public function searchItemsList()
       {
           /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'Add_item/searchItemsList/';
        $config['total_rows'] = $this->ItemModel->countProducts();

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

		$data['items'] = $this->ItemModel->fetch_items($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		$data['agency']=$this->ItemModel->fetch_agency();
		$data['count'] = $page;
		
		        $data['alert_color'] = $this->Mod_Common->alert_color();
            $this->load->view('table/header',$data);
            $this->load->view('add_item/item_list',$data);
            $this->load->view('table/footer');		      
	   }
  }  
