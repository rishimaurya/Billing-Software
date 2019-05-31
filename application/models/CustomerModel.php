<?php
defined('basepath') or ('No direct script access allowed.');
class CustomerModel extends CI_Model
{
  public function countCustomers()
	  {
         if( get_cookie('cName')!="" )
		 {
			 $this->db->like('customer_name',get_cookie('cName'));
		 }
		 if( get_cookie('cMobile')!="" )
		 {
			 $this->db->like('mobile',get_cookie('cMobile'));
		 }
		 if( get_cookie('cRef')!="" )
		 {
			 $this->db->like('reference',get_cookie('cRef'));
		 }
		 $query = $this->db->get('customer');
         return $query->num_rows();
	  }
	  
	  public function countCustomer()
	  {
         if( get_cookie('cName')!="" )
		 {
			 $this->db->like('customer_name',get_cookie('cName'));
		 }
		 if( get_cookie('cMobile')!="" )
		 {
			 $this->db->like('mobile',get_cookie('cMobile'));
		 }
		 if( get_cookie('cRef')!="" )
		 {
			 $this->db->like('reference',get_cookie('cRef'));
		 }
		 $query = $this->db->get('customer');
         return $query->num_rows();
	  }
	  
	 public function searchCustomers($limit,$page)
	  {
		 if( get_cookie('cName')!="" )
		 {
			 $this->db->like('customer_name',get_cookie('cName'));
		 }
		 if( get_cookie('cMobile')!="" )
		 {
			 $this->db->like('mobile',get_cookie('cMobile'));
		 }
		 if( get_cookie('cRef')!="" )
		 {
			 $this->db->like('reference',get_cookie('cRef'));
		 }
         $this->db->order_by("customer_name", "asc");
         $query = $this->db->get('customer',$limit,$page);
         //echo $this->db->last_query();         
         return $query->result();
	  }
	  
	  public function CustomersList($limit,$page)
	  {
		 $query = $this->db->get('customer',$limit,$page);
         return $query->result();
	  }
}
