<?php
defined('basepath') or ('No direct script access allowed.');
class Item extends CI_Controller
{
  public function index()
  {
      $this->load->view('invoice');
  }
}
?>