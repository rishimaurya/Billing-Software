<?php

 class ItemModel extends CI_Model
 { 
	  public function fetch_agency()
	  {
         $query = $this->db->get('agency');
		 return $query->result();
	  }
	  
	  public function check_duplicate($barcode)
      {
          $query = $this->db->query("select * from inventory where barcode_id='".$barcode."' ");
		  return $query->num_rows();		  
	  }
	  
	  public function form_insert($data)
      { 
		  $query = $this->db->insert('inventory', $data);
		  if($query)
		  {
			 return true; 
		  }
		  else
		     return false;
	  }
	  
	  public function form_update($data,$bar)
	  {
		    $query = $this->db->where('barcode_id',$bar);
		    $query = $this->db->update('inventory', $data);
		  if($query)
		  {
			 return true; 
		  }
		  else
		     return false;
      }
      	  
	  public function fetch_items($limit,$page)
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
         $query = $this->db->get('inventory',$limit,$page);
         //$query = $this->db->get();         
         return $query->result();
	  }
	  
	  public function countProducts()
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
		 $query = $this->db->get('inventory');
         return $query->num_rows();
	  }
	  public function fetch_selected_item($barcode)
	  {
		  $query = $this->db->query("select * from inventory where barcode_id='".$barcode."' ");
		  return $query->result();
	  }
 }	 
