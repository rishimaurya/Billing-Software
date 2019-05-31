<?php
defined('basepath') or ('No direct script access allowed.');
class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoicem');
        $this->load->model('Mod_Common');
        if ( ! $this->session->userdata('user'))
        { 
            redirect(base_url().'Login');
        }
    }
    
	public function index()
	{
        $id['inv_id'] = $this->Invoicem->getInvoiceId();
        		        $data['alert_color'] = $this->Mod_Common->alert_color();
	   if(!empty($id))
		{
			$this->load->view('add_item/add_item_header',$data);		
			$this->load->view('invoice',$id);
			$this->load->view('add_item/add_item_footer');
		}
       else return redirect(base_url().'Add_item/');
	}
	
	public function Autocomplete()
	{
	    $term = $_GET['term'];  
	    $client = $this->Invoicem->getClientData($term);
	    $cdata = array();
	    foreach($client as $cl)
	    {
	        $data['name'] = ucwords($cl->customer_name);
	        $data['mobile'] = $cl->mobile;
	        array_push($cdata, $data);
	    }
	    echo json_encode($cdata);
	}
	
	public function searchItem()
	{
		$bc_id = $_GET['barcode_id'];
		$res = $this->Invoicem->searchItem($bc_id);
		  $JSON = array(
		             'pname' => $res[0]->description,
		             'sp' => $res[0]->selling_price,
		             'cp' => $res[0]->cost_price,
		             'mrp' => $res[0]->mrp,
		             'unitsLeft'=> $res[0]->units
		              );
		  $JSON = json_encode($JSON);
		echo $JSON;
	}
	
	public function submitInvoice()
	{
	   if(!empty($_POST['br']))
	   {
		  $checkInvId = $this->Invoicem->checkInvId($_POST);
		  if($checkInvId)
		  {
		      $status = $this->Invoicem->createInvoice($_POST);
		      if($status)
		      {
				  $invoiceId = base64_encode($_POST['invoicen']);
				  return redirect(base_url('Invoice/printInvoice?InvoiceId='.$invoiceId));
			  }
			  else
			  {
			     $this->session->set_flashdata('error','Something Went wrong Try again.Please Refresh The Page.');
				 return redirect(base_url().'Invoice');
			  }
		  }
		  else
		  {
				$this->session->set_flashdata('error','Something Went wrong Try again.Please Refresh The Page.');
				return redirect(base_url().'Invoice');    
	      }
	   }
	   else
	   {
		   $this->session->set_flashdata('error','Something Went wrong Try again');
		    return redirect(base_url().'Invoice');
	   }   
	}
	
	public function printInvoice()
	{
	    $invoice_data['ivd'] = $inv_id = base64_decode($_GET['InvoiceId']);
	    $invoice_data = $this->Invoicem->getInvData($inv_id);
	   // print_r($invoice_data);
	   if($invoice_data)
	    {		        $data['alert_color'] = $this->Mod_Common->alert_color();
			$this->load->view('add_item/add_item_header',$data);
			$this->load->view('printInvoice',$invoice_data);
			$this->load->view('add_item/add_item_footer');
		}
	   else
	    {
			$this->session->set_flashdata('error','Invoice Not Found.');
		    return redirect(base_url().'Invoice');
		}
	}
	
	public function updateInvoice()
	{
	    $invoice_data['id'] = $inv_id = base64_decode($_GET['InvoiceId']);
	    $invoice_data = $this->Invoicem->getInvData($inv_id);
	    // print_r($invoice_data);
	   if($invoice_data)
	    {		        $data['alert_color'] = $this->Mod_Common->alert_color();
			$this->load->view('add_item/add_item_header',$data);
			$this->load->view('updateInvoice',$invoice_data);
			$this->load->view('add_item/add_item_footer');
		}
	   else
	    {
			$this->session->set_flashdata('error','Invoice Not Found.');
		    return redirect(base_url().'Invoice');
		}
	}
	
	public function submitUpdateInvoice()
	{
	   if(!empty($_POST['br']))
	   {
		  $checkInvId = $this->Invoicem->checkUpdateInvId($_POST);
		  if($checkInvId)
		  {
		      $status = $this->Invoicem->updateInvoice($_POST);
		      if($status)
		      {
				  $invoiceId = base64_encode($_POST['invoicen']);
				  return redirect(base_url('Invoice/printInvoice?InvoiceId='.$invoiceId));
			  }
			  else
			  {
			     $this->session->set_flashdata('error','Something Went wrong Try again.Please Refresh The Page.');
				 return redirect(base_url().'Invoice');
			  }
		  }
		  else
		  {
				$this->session->set_flashdata('error','Something Went wrong Try again.Please Refresh The Page.');
				return redirect(base_url().'Invoice');    
	      }
	   }
	   else
	   {
		   $this->session->set_flashdata('error','Something Went wrong Try again');
		    return redirect(base_url().'Invoice');
	   }   
	}
}
?>
