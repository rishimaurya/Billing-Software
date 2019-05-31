<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mod_Common extends CI_Model {
		public function __construct(){
			parent::__construct();
			
			}
		public function selectData($fields='*', $tableName , $condition=array(), $limit='',$start='')
		{
			$this->db->select($fields);
			/*Check for Condition*/
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			/*Get Data form table*/
			$this->db->from($tableName);
			$this->db->limit($limit,$start);
			$query = $this->db->get();	
			$result = $query->result();
			return $result;
		}
		public function rowData($tableName, $condition=array(), $fields='*')
		{
			$this->db->select($fields);
			/*Check for Condition*/
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			/*Get Data form table*/
			$this->db->from($tableName);
			$query = $this->db->get();	
			$result = $query->row();
			return $result;
		}
		public function count($fields='*' , $tableName , $condition=array() )
		{
			$this->db->select($fields);
			/*Check for Condition*/
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			/*Get Data form table*/
			$this->db->from($tableName);
			$query = $this->db->get();	
			$result = $query->num_rows();
			
			return $result;
		}
		/******************************
		Function: insertData
		Role: Insert given data in given table
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function insertData($tableName, $data)
		{
			$this->db->insert($tableName, $data);
			
			return $this->db->insert_id();
		}
		/******************************
		Function: admin_profile
		Role: Update data in given table with specific condition
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function updateData($tableName, $condition=array(), $data)
		{
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			$this->db->update($tableName, $data);
			return true;
		}
		/******************************
		Function: admin_profile
		Role: Run and return result for the given query
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function customQuery($query)
		{
			$query = $this->db->query($query);
			$result = $query->result();
			
			return $result;
		}
		public function alterDbQuery($query)
		{
			$query = $this->db->query($query);
			return true;
		}
	
		public function deleteData($tableName, $condition=array())
		{
			if (!empty($condition)) {
				$this->db->where($condition);
			}
			
			$this->db->delete($tableName);
			return true;
		}
		public function customDeleteQuery($query)
		{
			$query = $this->db->query($query);
			return true;
		}
		
		/******************************
		Function: select Max. Field value
		Role: select data from given table with specific conditions
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function selectMaxData($tableName, $fields)
		{
			$this->db->select_max($fields);
			$result = $this->db->get($tableName)->row();  
			return $result->$fields;
		}
		/******************************
		Function: Select matched records of any table Sorted Data
		Role: Run and return result for the given query
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function selectDataOrderBy($tableName, $condition=array(),$sortBy,$orderBy, $fields='*')
		{
			$this->db->select($fields);
			/*Check for Condition*/
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			/*Get Data form table*/
			$this->db->from($tableName);
			$this->db->order_by($sortBy,$orderBy);
			$query = $this->db->get();	
			$result = $query->result();
			echo $this->db->last_query();
			return $result;
		}
		/******************************
		Function: Select all records of any table Sorted Data
		Role: Run and return result for the given query
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function selectAllDataOrderBy($tableName,$sortBy,$orderBy, $fields='*')
		{
			$this->db->select($fields);
			/*Get Data form table*/
			$this->db->from($tableName);
			$this->db->order_by($sortBy,$orderBy);
			$query = $this->db->get();	
			$result = $query->result();
			return $result;
		}
		/******************************
		Function: Update bulk records based on single condition
		Role: Run and return result for the given query
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function customUpdateQuery($query)
		{
			$query = $this->db->query($query);
			//$result = $query->result();
			return $query;
		}
		/******************************
		Function: Get Month Number from Full Month name
		Role: Check Month Name and return the Month Number
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function getMonthNumber($m){
			if($m=="January"){
				return 1;
			}else if($m=="February"){
				return 2;
			}else if($m=="March"){
				return 3;
			}else if($m=="April"){
				return 4;
			}else if($m=="May"){
				return 5;
			}else if($m=="June"){
				return 6;
			}else if($m=="July"){
				return 7;
			}else if($m=="August"){
				return 8;
			}else if($m=="September"){
				return 9;
			}else if($m=="October"){
				return 10;
			}else if($m=="November"){
				return 11;
			}else if($m=="December"){
				return 12;
			}
		}
		/******************************
		Function: Get Month Full Name from Full Month number
		Role: Check Month Number and return the Month Full Name
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function getMonthName($m){
			if($m==1){
				return "January";
			}else if($m==2){
				return "February";
			}else if($m==3){
				return "March";
			}else if($m==4){
				return "April";
			}else if($m==5){
				return "May";
			}else if($m==6){
				return "June";
			}else if($m==7){
				return "July";
			}else if($m==8){
				return "August";
			}else if($m==9){
				return "September";
			}else if($m==10){
				return "October";
			}else if($m==11){
				return "November";
			}else if($m==12){
				return "December";
			}
		}
		/******************************
		Function: Get all dates between two dates
		Role: Check dates and return all the dates including given dates
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function dates_bw_dates($a,$b)
		{
			$start = $a;
			$end = $b;
			$init_date = strtotime($start);
			$dst_date = strtotime($end);
			$offset = $dst_date-$init_date;
			$dates = floor($offset/60/60/24) + 1;
			$date_array=array();
			for ($i = 0; $i < $dates; $i++)
			{
			$newdate = date("Y-m-d", mktime(12,0,0,date("m", strtotime($start)),
			(date("d", strtotime($start)) + $i), date("Y", strtotime($start))));
			$date_array[$i]=$newdate;
			}
			return $date_array;
		}
		/******************************
		Function: Get total days between two dates
		Role: Check dates and return total days including given dates
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function total_days_including_startdate($a,$b)
		{
			$start = $a;
			$end = $b;
			$init_date = strtotime($start);
			$dst_date = strtotime($end);
			$offset = $dst_date-$init_date;
			$totalDays = floor($offset / (60 * 60 * 24))+1;
			return $totalDays;
		}
		/******************************
		Function: Get all Months between two dates
		Role: Check dates and return all months between given dates
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function get_months($date1, $date2) { 
		   $time1  = strtotime($date1); 
		   $time2  = strtotime($date2); 
		   $my     = date('mY', $time2); 
		
		   $months = array(date('F-Y', $time1)); 
		
		   while($time1 < $time2) { 
			  $time1 = strtotime(date('Y-m-d', $time1).' +1 month'); 
			  if(date('mY', $time1) != $my && ($time1 < $time2)) 
				 $months[] = date('F-Y', $time1); 
		   } 
		
		   $months[] = date('F-Y', $time2); 
		   return $months; 
		}
		/******************************
		Function: Get language keyword based on given label
		Role: Check language and run query for given label and return the keyword
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function selectLangKeyword($label)
		{
			if($_SESSION['site_lang'] == 'hindi')
			{
				$query="select language_label_hindi as lKeyword from language_labels_master where language_label='".$label."'";
			}
			else
			{
				$query="select language_label_english as lKeyword from language_labels_master where language_label='".$label."'";
			}
			$query = $this->db->query($query);
			$result = $query->result();
			if($result[0]->lKeyword=="")
			{
				return $label;
			}
			else
			{
				return $result[0]->lKeyword;
			}
		}
		/*public function selectLangKeyword($label)
		{
			if($_SESSION['site_lang'] == 'hindi')
			{
				$query="select language_label_hindi as lKeyword from language_labels_master where language_label='".$label."'";
			}
			else
			{
				$query="select language_label_english as lKeyword from language_labels_master where language_label='".$label."'";
			}
			$query = $this->db->query($query);
			$result = $query->result();
			return $result[0]->lKeyword;
		}*/
		/******************************
		Function: Get Current Date in DB Form
		Role: Check time Zone of current location and Get current Date based on current location
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function get_current_date()
		{
			 return date('Y-m-d',mktime(date("H")+12,date("i")+30,date("s"),date("m"),date("d"),date("Y")));
			 /*return date('Y-m-d',mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));*/
		}
		/******************************
		Function: Get Current Time in DB Form
		Role: Check time Zone of current location and Get current Time based on current location
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function get_current_time()
		{
			 return date('H:i:s',mktime(date("H")+12,date("i")+30,date("s"),date("m"),date("d"),date("Y")));
			 /*return date('H:i:s',mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));*/
		}
		/******************************
		Function: Get Current DateTime in DB Form
		Role: Check time Zone of current location and Get current DateTime based on current location
		Owner: Vibs Infosol
		Created At: 28 November, 2017
		*******************************/
		public function get_current_datetime()
		{
			 return date('Y-m-d H:i:s',mktime(date("H")+12,date("i")+30,date("s"),date("m"),date("d"),date("Y")));
			 /*return date('Y-m-d H:i:s',mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));*/
		}
		
		public function selectOrdered($fields='*', $tableName , $condition=array(), $limit='',$start='',$column='',$order='')
		{
			$this->db->select($fields);
			/*Check for Condition*/
			if ($condition!='' || !empty($condition)) {
				$this->db->where($condition);
			}
			/*Get Data form table*/
			$this->db->from($tableName);
			$this->db->order_by($column,$order);
			$this->db->limit($limit,$start);
			$query = $this->db->get();	
			$result = $query->result();
			return $result;
		}
		
		public function alert_color()
		{
			
		   $this->db->where('inventory.units <= inventory.low_units');

		 $query = $this->db->get('inventory');

         return $query->num_rows();	
			}
		
		
	}
	/* End of file Mod_Common.php */
 ?>
