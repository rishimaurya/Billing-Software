<?php

 class DashboardModel extends CI_Model
 { 
     public function calculate_todays_sale()
     {
		 $date=DATE('Y-m-d');
		 $query = $this->db->query("select sum(total) as ta1 from invoice where sale_date='".$date."'");
         if($query->num_rows() > 0)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }		 
	 } 
     
     public function calculate_monthly_sale()
     {
		 $a=DATE('Y-m');
         $start=$a."-01"; 
         $end= $a."-31";
		 $query = $this->db->query("select sum(total) as ta1 from invoice where sale_date between '".$start."' and '".$end."'");
         if($query->num_rows() > 0)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }
     }	 
     
     public function calculate_todays_profit()
     {
		 $date=DATE('Y-m-d');
		 $query = $this->db->query("select sum(profit) as ta1 from invoice where sale_date='".$date."'");
         if($query->num_rows() > 0)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }		 
	 }
	 
     public function calculate_monthly_profit()
     {
		 $a=DATE('Y-m');
         $start=$a."-01"; 
         $end= $a."-31";
		 $query = $this->db->query("select sum(profit) as ta1 from invoice where sale_date between '".$start."' and '".$end."'");
         if($query->num_rows() > 0)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }
	 }
	 
	 public function total_invoice()
	 {
		 $date=DATE('Y-m-d');
		 $query = $this->db->query("select * from invoice where sale_date='".$date."'");
		 return $query->num_rows();
	 }

	 public function total_month_invoice()
	 {
		 $a=DATE('Y-m');
         $start=$a."-01"; 
         $end= $a."-31";
		 $query = $this->db->query("select * from invoice where sale_date between '".$start."' and '".$end."'");
		 return $query->num_rows();		 
	 }
	 
	 
	 public function calculate_monthly_sale_last($d)
	 {
         $start=$d."-01"; 
         $end= $d."-31";
         $query = $this->db->query("select sum(total) as ta1 from invoice where sale_date between '".$start."' and '".$end."'");//echo "<br/>".$this->db->last_query();
         if($query->num_rows() > 0 and $query->row_array()['ta1']!=NULL)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }
	 }	 

	 public function calculate_monthly_profit_last($d)
	 {
         $start=$d."-01"; 
         $end= $d."-31";
         $query = $this->db->query("select sum(profit) as ta1 from invoice where sale_date between '".$start."' and '".$end."'");//echo "<br/>".$this->db->last_query();
         if($query->num_rows() > 0 and $query->row_array()['ta1']!=NULL)
         { 
            $res = $query->row_array();
            $total=$res['ta1'];
            return $total;	
	     }
	 }	 
	 public function calculate_monthly_invoice_last($d)
	 {
         $start=$d."-01"; 
         $end= $d."-31";
         $query = $this->db->query("select * from invoice where sale_date between '".$start."' and '".$end."'");
         if($query->num_rows() > 0)
         { 
            return $query->num_rows();
	     }
	 }	 
 }
