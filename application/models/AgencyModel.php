<?php

 class AgencyModel extends CI_Model
 { 
	  public function countAgency()
	  {
         if( get_cookie('aName')!="" )
		 {
			 $this->db->like('agency_name',get_cookie('aName'));
		 }
		 if( get_cookie('aOwner')!="" )
		 {
			 $this->db->like('owner',get_cookie('aOwner'));
		 }
		 if( get_cookie('aMobile')!="" )
		 {
			 $this->db->like('mobile',get_cookie('aMobile'));
		 }
		 $query = $this->db->get('agency');
         return $query->num_rows();
	  }
	  
	  public function searchAgency($limit,$page)
	  {
         if( get_cookie('aName')!="" )
		 {
			 $this->db->like('agency_name',get_cookie('aName'));
		 }
		 if( get_cookie('aOwner')!="" )
		 {
			 $this->db->like('owner',get_cookie('aOwner'));
		 }
		 if( get_cookie('aMobile')!="" )
		 {
			 $this->db->like('mobile',get_cookie('aMobile'));
		 }
		 $this->db->order_by("agency_name", "asc");
		 $query = $this->db->get('agency',$limit,$page);
         //echo $this->db->last_query();         
         return $query->result();
	  }
	   
	   public function check_duplicate($agency)
      {
          $query = $this->db->query("select * from agency where agency_name='".$agency."' ");
		  return $query->num_rows();		  
	  }
	  
	  public function form_insert($data)
	  {
		  $query = $this->db->insert('agency', $data);
		  if($query)
		  {
			 return true; 
		  }
		  else
		     return false;
	  }
	  
	  public function fetch_agency()
	  {
         $query = $this->db->get('agency');
		 return $query->result();
	  }	  
	  
	  public function agency_name($id)
	  {
		  $query = $this->db->query("select * from agency where id='".$id."' ");
		  return $query->result();
      }
      
      public function bill_insert($data,$data1)
      {
		  $query = $this->db->insert('agency_bill', $data);
		 $this->db->insert('agency_bill_record', $data1);
		  if($query)
		  {
			 return true; 
		  }
		  else
		     return false;		  
	  }
	  
	  public function bill_details($limit,$page,$id)
	  {
		  $query = $this->db->query("select * from agency_bill where agency_id='".$id."' order by id desc limit $page,$limit ");
		  return $query->result();
	  }
	  
	  public function countBill_details($id)
	  {
		  $query = $this->db->query("select * from agency_bill where agency_id='".$id."'");
		  return $query->num_rows();
	  }
	  
	  public function bill_detail($id,$bill)
      {
		  $query = $this->db->query("select * from agency_bill where agency_id='".$id."' and bill_no='".$bill."'");
		  return $query->result();
	  }
	  
	  public function add_payment($data,$data1,$agency_id,$bill_no)
	  {
		  $this->db->insert('agency_bill_record',$data);
          $query1 = $this->db->where('agency_id', $agency_id);
          $query1 = $this->db->where('bill_no', $bill_no);
		  $query1 = $this->db->update('agency_bill', $data1);
	  }
	  
	  public function bill_history($limit,$page,$id,$bill)
	  {
		  $query = $this->db->query("select * from agency_bill_record where agency_id='".$id."' and bill_no='".$bill."' limit $page,$limit ");
		  return $query->result();		
	  }
	  
	  public function countBill_history($id,$bill)
	  {
		  $query = $this->db->query("select * from agency_bill_record where agency_id=$id and bill_no=$bill");
		  return $query->num_rows();		
	  }
	  
	  public function agency_update($id,$data)
	  {
		  $query1 = $this->db->where('id', $id);
		  $query1 = $this->db->update('agency', $data);
	  }	  
	  
	  public function delete_agency($id)
	  {
		  $this->db->query("delete from agency where id='".$id."'");  
	  }
	  
	  public function check_bill($bill_no)
	  {
		  $row = $this->db->query("select * from agency_bill where bill_no='".$bill_no."'");
		  return $row->num_rows();  
	  }	  
	 
	  
	  public function change_billno($agency,$prev,$bill_no)
	  {
	      $row = $this->db->query("update agency_bill set bill_no='".$bill_no."' where agency_id='".$agency."' and bill_no='".$prev."'");
	      $row = $this->db->query("update agency_bill_record set bill_no='".$bill_no."' where agency_id='".$agency."' and bill_no='".$prev."'");
	
	  }
	  
	  public function changeDate($agency,$bill_no,$prevdate,$date)
	  {
	      $row = $this->db->query("update agency_bill set date='".$date."' where agency_id='".$agency."' and bill_no='".$bill_no."'");	  
	  }
	  
	  public function change_billamount($agency,$prev,$bill_no)
	  {
		$row = $this->db->query("update agency_bill set bill_no='".$bill_no."' where agency_id='".$agency."' and bill_no='".$prev."'");
	  }
 }	 
