<?php
defined('basepath') or ('No direct script access allowed.');
class Invoicem extends CI_Model
{
    public function searchItem($bid)
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('barcode_id',$bid);
        $result = $this->db->get();
		return $result->result();
    }
    
    public function getClientData($term)
    {
        $this->db->select('customer_name,mobile');
        $this->db->from('customer');
        $this->db->like('customer_name',$term);
        $this->db->or_like('mobile',$term);
        $result = $this->db->get();
		return $result->result();
    }
    
    public function getInvoiceId()
    {
        return $count=$this->db->count_all('invoice');
    }
    
    public function checkInvId($ID)
    {
	   $this->db->select('*');
	   $this->db->from('invoice');
	   $this->db->where('sale_id',$ID['invoicen']);
	   $result=$this->db->get();
	   $status = $result->num_rows();
	   if($status)
	   {
	      return false;
	   }
	   else 
	   {
	      $this->db->select('*');
	      $this->db->from('invoice_detail');
	      $this->db->where('sale_id',$ID['invoicen']);
	      $result=$this->db->get();
	      $statusI = $result->num_rows();
	      if($statusI)
	      {
		     return false;
		  }
	      else return true;
	   }
	}
    
    public function updateInvoice($data)
    {
		$inv_data = array(
                       'client_name' => $data['client'],
                       'client_mobile'=>$data['mobile'],
                       'total' => $data['netTotal'],
                       'profit' => $data['profit'],
                       'sale_date' => $data['invoice_date']
                       );
               $this->db->where('sale_id',$data['invoicen']);
        $sql = $this->db->update('invoice',$inv_data);
        
        $this->db->query("delete from customer_bill where sale_id='".$data['invoicen']."'");
        $this->db->query("delete from customer_bill_detail where sale_id='".$data['invoicen']."'");
        
	   if($sql)
		{
			$c = $this->db->query("select * from customer where mobile='".$data['mobile']."'");
				 $customer = $c->result();
				 $count = $c->num_rows();
				 if($count==0)
				 {
					 $cust = array(
                       'customer_name' => $data['client'],
                       'mobile'=>$data['mobile']);
					 $this->db->insert('customer',$cust);
					 $customer_id = $this->db->insert_id();
				 }
			     	if(!empty($customer))foreach($customer as $ca)
			      {
					  $customer_id = $ca->customer_id;
				  }
			     $cust_bill = array(
			                        'customer_id'=>$customer_id,
			                        'sale_id'=>$data['invoicen'],
			                        'bill_total'=>$data['netTotal'],
			                        'payment'=>$data['payment'],
			                        'sale_date' => $data['invoice_date']
			                        );
			     $this->db->insert('customer_bill',$cust_bill);
			     if(!isset($data['cheque_no']))
			     {
					 $cheque_no = 0;
				 }
				 else
				 {
					 $cheque_no = $data['cheque_no'];
				 }
			     $cust_bill_detail = array(
			                        'customer_id'=>$customer_id,
			                        'sale_id'=>$data['invoicen'],
			                        'bill_total'=>$data['netTotal'],
			                        'date'=>DATE('Y-m-d'),
			                        'payment'=>$data['payment'],
			                        'payment_mode'=>$data['mode'],
			                        'cheque_no'=>$cheque_no);
			     $this->db->insert('customer_bill_detail',$cust_bill_detail);
			$this->db->where('sale_id',$data['invoicen']);
			$status = $this->db->delete('invoice_detail');
			if($status)
			{
				$i=0;$total_items=$data['totalItems'];
						 while($i < $total_items)
						 {
							 $iv_data = array(
										  'sale_id' => $data['invoicen'],
										  'product_id'=> $data['br'][$i],
										  'quantity'=> $data['quantity'][$i],
										  'inv_mrp'=> $data['mrp'][$i],
                                          'costprice'=> $data['cPrice'][$i],
										  'price'=> $data['uPrice'][$i]
										  );
							 $sqlP = $this->db->insert('invoice_detail',$iv_data);
							 $i++;
						 }
				return true;
			}
			else return false;
		} else return false;
        
    }
    
    public function getInvData($ivId)
    {
		$data = array();
		$this->db->select('*');
		$this->db->from('invoice');
		$this->db->where('sale_id',$ivId);
		$res = $this->db->get();
		$res = $res->result();
		$data['iv'] = $res;
		if($res)
		{
			$this->db->select('inventory.*,invoice_detail.*');
		    $this->db->from('invoice_detail');
		    $this->db->join('inventory','inventory.barcode_id=invoice_detail.product_id');
			$this->db->where('sale_id',$ivId);
			$result = $this->db->get();
			$result = $result->result();
			$data['item'] = $result;
		  return $data;
		}
	}
	
	public function checkUpdateInvId($ID)
    {
	   $this->db->select('*');
	   $this->db->from('invoice');
	   $this->db->where('sale_id',$ID['invoicen']);
	   $result=$this->db->get();
	   $status = $result->num_rows();
	   if($status)
	   {
	      $this->db->select('*');
	      $this->db->from('invoice_detail');
	      $this->db->where('sale_id',$ID['invoicen']);
	      $result=$this->db->get();
	      $statusI = $result->num_rows();
	      if($statusI)
	      {
		     return true;
		  }
	   }
	   else 
	   {
	       return true;
	   }
	}
	
	public function createInvoice($data)
    {

          $inv_data = array(
                       'sale_id' => $data['invoicen'],
                       'client_name' => $data['client'],
                       'client_mobile'=>$data['mobile'],
                       'total' => $data['netTotal'],
                       'profit' => $data['sprofit'],
                       'discount' => $data['cdiscount'],
                       'sale_date' => $data['invoice_date']
                       );
            $sql = $this->db->insert('invoice',$inv_data);
            $bill_no = $this->db->insert_id();
            if($sql)
              {
				 $c = $this->db->query("select * from customer where mobile='".$data['mobile']."'");
				 $customer = $c->result();
				 $count = $c->num_rows();
				 if($count==0)
				 {
					 $cust = array(
                       'customer_name' => $data['client'],
                       'mobile'=>$data['mobile']);
					 $this->db->insert('customer',$cust);
					 $customer_id = $this->db->insert_id();
				 }
			      if(!empty($customer))foreach($customer as $ca)
			      {
					  $customer_id = $ca->customer_id;
				  }
			     $cust_bill = array(
			                        'customer_id'=>$customer_id,
			                        'sale_id'=>$bill_no,
			                        'bill_total'=>$data['netTotal'],
			                        'payment'=>$data['payment'],
			                        'date' => $data['invoice_date']
			                        );
			     $this->db->insert('customer_bill',$cust_bill);
			     if(!isset($data['cheque_no']))
			     {
					 $cheque_no = 0;
				 }
				 else
				 {
					 $cheque_no = $data['cheque_no'];
				 }
			     $cust_bill_detail = array(
			                        'customer_id'=>$customer_id,
			                        'sale_id'=>$bill_no,
			                        'bill_total'=>$data['netTotal'],
			                        'date'=>DATE('Y-m-d'),
			                        'payment'=>$data['payment'],
			                        'payment_mode'=>$data['mode'],
			                        'cheque_no'=>$cheque_no);
			     $this->db->insert('customer_bill_detail',$cust_bill_detail);
			     
                 $i=0;$total_items=$data['totalItems'];
                 while($i < $total_items)
                 {
                     $iv_data = array(
                                  'sale_id' => $data['invoicen'],
                                  'product_id'=> $data['br'][$i],
                                  'quantity'=> $data['quantity'][$i],
                                  'inv_mrp'=> $data['mrp'][$i],
                                  'costprice'=> $data['cPrice'][$i],
                                  'price'=> $data['uPrice'][$i]
                                  );
                     $sqlP = $this->db->insert('invoice_detail',$iv_data);
                     $i++;
                 }
              }
        return true;
       }
}
?>
