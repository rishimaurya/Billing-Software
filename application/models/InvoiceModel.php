<?php
defined('basepath') or ('No direct script access allowed.');
class InvoiceModel extends CI_Model
{
	public function fetch_bill($limit,$page)
	{
	   if( get_cookie('bill')!="" )
		 {
			 $this->db->where('sale_id',get_cookie('bill'));
		 }
		 if( get_cookie('customer')!="" )
		 {
			 $this->db->like('client_name',get_cookie('customer'));
		 }
		 if( get_cookie('mobile')!="" )
		 {
			 $this->db->where('client_mobile',get_cookie('mobile'));
		 }
		 if( get_cookie('date')!="" )
		 {
			 $this->db->where('sale_date',get_cookie('date'));
		 }
	   $this->db->order_by('sale_id','DESC');
	   $query = $this->db->get('invoice',$limit,$page);
	   
	   return $query->result();	
	}
	
	public function countFetch_bill()
	{
		if( get_cookie('bill')!="" )
		 {
			 $this->db->where('sale_id',get_cookie('bill'));
		 }
		 if( get_cookie('customer')!="" )
		 {
			 $this->db->like('client_name',get_cookie('customer'));
		 }
		 if( get_cookie('mobile')!="" )
		 {
			 $this->db->where('client_mobile',get_cookie('mobile'));
		 }
		 if( get_cookie('date')!="" )
		 {
			 $this->db->where('sale_date',get_cookie('date'));
		 }
	   $query = $this->db->get('invoice');
	   return $query->num_rows();	
	}
	
	public function alert($limit,$page)
	{
	   if( get_cookie('barcode')!="" )
		 {
			 $this->db->where('barcode_id',get_cookie('barcode'));
		 }
		 if( get_cookie('productName')!="" )
		 {
			 $this->db->like('description',get_cookie('productName'));
		 }
		 if( get_cookie('agency')!="" )
		 {
			 $this->db->where('category',get_cookie('agency'));
		 }
		 if( get_cookie('units')!="" )
		 {
			 $this->db->where('units',get_cookie('units'));
		 }
		   $this->db->where('inventory.units <= inventory.low_units');
		 $query = $this->db->get('inventory',$limit,$page);
         return $query->result();	
	}
	
	public function countAlert()
	{
	   if( get_cookie('barcode')!="" )
		 {
			 $this->db->where('barcode_id',get_cookie('barcode'));
		 }
		 if( get_cookie('productName')!="" )
		 {
			 $this->db->like('description',get_cookie('productName'));
		 }
		 if( get_cookie('agency')!="" )
		 {
			 $this->db->where('category',get_cookie('agency'));
		 }
		 if( get_cookie('units')!="" )
		 {
			 $this->db->where('units',get_cookie('units'));
		 }
		   $this->db->where('inventory.units <= inventory.low_units');
		 $query = $this->db->get('inventory');
         return $query->num_rows();	
	}
}	
