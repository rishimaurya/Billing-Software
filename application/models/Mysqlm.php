<?php
 class Mysqlm extends CI_Model
 { 
	 public function insert()
	 {
		 $db1 = $this->load->database('remote', TRUE);
		
		//Agency
		$query = $this->db->where('bkup',0)->get('agency');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM agency WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('agency',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update agency set bkup=1 where bkup = 0');
				}
		  }
		  
		//Agency_bill
		$query = $this->db->where('bkup',0)->get('agency_bill');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM agency_bill WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('agency_bill',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update agency_bill set bkup=1 where bkup = 0');
				}
		}
		
		//agency_bill_record
		$query = $this->db->where('bkup',0)->get('agency_bill_record');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM agency_bill_record WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('agency_bill_record',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update agency_bill_record set bkup=1 where bkup = 0');
				}
		  }
		
		//customer
		$query = $this->db->where('bkup',0)->get('customer');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->customer_id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM customer WHERE customer_id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('customer',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update customer set bkup=1 where bkup = 0');
				}
		}
		
		//customer_bill
		$query = $this->db->where('bkup',0)->get('customer_bill');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM customer_bill WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('customer_bill',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update customer_bill set bkup=1 where bkup = 0');
				}
		  }
		
		//customer_bill_detail
		$query = $this->db->where('bkup',0)->get('customer_bill_detail');
		if($query->num_rows() > 0)
	     {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM customer_bill_detail WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('customer_bill_detail',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update customer_bill_detail set bkup=1 where bkup = 0');
				}
		  }
		
		//invoice
		$query = $this->db->where('bkup',0)->get('invoice');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->sale_id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM invoice WHERE sale_id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('invoice',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update invoice set bkup=1 where bkup = 0');
				}
			}
		
		//invoice_detail
		$query = $this->db->where('bkup',0)->get('invoice_detail');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM invoice_detail WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('invoice_detail',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update invoice_detail set bkup=1 where bkup = 0');
				}
		 }
		
		
		
		//users
		$query = $this->db->where('bkup',0)->get('users');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('DELETE FROM users WHERE id IN ('.$id.')');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('users',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						$query = $this->db->query('update users set bkup=1 where bkup = 0');
				}
		 }
		 
		 //inventory
		$query = $this->db->get('inventory');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->barcode_id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('TRUNCATE inventory');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('inventory',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						//$query = $this->db->query('update inventory set bkup=1 where bkup = 0');
				}
			}
		
		//new_inventory
		$query = $this->db->get('new_inventory');
		if($query->num_rows() > 0)
		 {
				$id = "";
				foreach ($query->result() as $row) {
						  $id .= $row->barcode_id.",";
					}$id .= '0';
					
				
				$db1->trans_begin();
				
				$delete = $db1->query('TRUNCATE new_inventory');
				
				if($delete)
				{
					foreach ($query->result() as $row) {
						  $db1->insert('new_inventory',$row);
					}
				}
				
				if ($db1->trans_status() === FALSE)
				{
						$db1->trans_rollback();
				}
				else
				{
						$db1->trans_commit();
						//$query = $this->db->query('update new_inventory set bkup=1 where bkup = 0');
				}
		 }
		
	 }
 }	 
