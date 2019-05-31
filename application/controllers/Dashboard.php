<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class Dashboard extends CI_Controller
  {
        function __construct() {
        parent::__construct();
        $this->load->model('DashboardModel');
        $this->load->model('Mod_Common');
        if ( ! $this->session->userdata('user'))
        { 
            $this->session->set_flashdata('error','Please Login Again');
            redirect(base_url().'Login');
        }
    }

     
      public function index()
      {
		   $data['sale'] = $this->DashboardModel->calculate_todays_sale();
		   $data['msale'] = $this->DashboardModel->calculate_monthly_sale();
		   $data['profit'] = $this->DashboardModel->calculate_todays_profit();
		   $data['mprofit'] = $this->DashboardModel->calculate_monthly_profit();
		   $data['invoice'] = $this->DashboardModel->total_invoice();
		   $data['minvoice'] = $this->DashboardModel->total_month_invoice();
           for($i=1; $i<=12; $i++)
           {
             $d = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));

             $MS = $this->DashboardModel->calculate_monthly_sale_last($d);
             $MP = $this->DashboardModel->calculate_monthly_profit_last($d);
             $MI = $this->DashboardModel->calculate_monthly_invoice_last($d);

             $data['lsale'][$i]= $MS!='' ? $MS : 0;
             $data['lprofit'][$i]= $MP!='' ? $MP : 0;  
             $data['linvoice'][$i]= $MI!='' ? $MI : 0;  
           }

        $data['alert_color'] = $this->Mod_Common->alert_color();
           $this->load->view('dash_header',$data);
           $this->load->view('dash',$data);
           $this->load->view('add_item/add_item_footer');    
           
     }
}
