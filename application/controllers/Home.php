<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Home extends CI_Controller {


	public function __construct(){
        parent::__construct();
        $this->load->helper('customer_session');
        customerchecksession();
    }

	public function index()
	{	
		$viewData = array(
			"setting"  => $this->common_model->get(['id'=>1],'ayarlar'),
			"websites" => $this->common_model->getlimit(['durum' => 1, 'siteekleyen' => $this->session->userdata('admincode')],20,0,'websiteler','siteid','DESC'),
			"dnslist"  => $this->common_model->getlimit(['dnsdurum'=>1, 'dnsekleyen' => $this->session->userdata('admincode')],20,0,'dnsler','dnsid','DESC'),
		);
		$this->load->view('home_view',$viewData);
	}
}
