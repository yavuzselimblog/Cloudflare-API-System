<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dns extends CI_Controller {


	public function __construct(){
        parent::__construct();
        $this->load->helper('customer_session');
        customerchecksession();
    }


    public function delete($id){

        if(!$id){
            redirect(base_url());
        }

        $dnsquery = $this->common_model->get(['dnsid' => $id, 'dnsekleyen' => $this->session->userdata('admincode')],'dnsler');
        if($dnsquery){


                $websitequery = $this->common_model->get(['sitekodu' => $dnsquery->dnswebsite,'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
                $api_key      = $this->session->userdata('apikey');
                $email        = $this->session->userdata('apimail');
                $zone_id      = $websitequery->sitezone;
                

                // Silinecek DNS kaydının kimliğini tanımlayın
                $record_id = $dnsquery->cloudflareip;

                // Cloudflare API'sini çağırarak DNS kaydını silin
                $url = "https://api.cloudflare.com/client/v4/zones/{$zone_id}/dns_records/{$record_id}";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "X-Auth-Email: {$email}",
                    "X-Auth-Key: {$api_key}"
                ));
                $response = curl_exec($curl);
                curl_close($curl);

                // Yanıtı işleyin ve sonucu gösterin
               // $result = json_decode($response, true);
                $this->common_model->delete(['dnsid' => $id,'dnsekleyen' => $this->session->userdata('admincode')],'dnsler');
                redirect(base_url('dns/list'));

                



        }else{
            redirect(base_url());
        }

    }

	public function list()
	{	

		$perPage = 20;
        $pageSegment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $links = paginationHelper(base_url('dns/list/'),
            $this->common_model->getcount(['dnsekleyen' => $this->session->userdata('admincode')], 'dnsler'),
            $perPage, 3, TRUE, []);

        $query = $this->common_model->get(['id' => 1],'ayarlar');
        $viewData  = array(

            "setting"       => $query,           
            "dnslist"   => $this->common_model->getlimit(['dnsekleyen' => $this->session->userdata('admincode')], $perPage, ($pageSegment - 1) * $perPage, 'dnsler','dnsid','DESC'),
            "dnslinks"  => $links,
            "dnscount"  => $this->common_model->getcount(['dnsekleyen' => $this->session->userdata('admincode')], 'dnsler')
            
        );
        $this->load->view('dnslist_view',$viewData);

	}


    public function new(){

        $viewData = array(
            "website"  => $this->common_model->getAll(['durum' => 1,'siteekleyen' => $this->session->userdata('admincode')],'websiteler'),
			"setting"  => $this->common_model->get(['id'=>1],'ayarlar'),
		);
		$this->load->view('newdns_view',$viewData);

    }


    function newdata(){


        if($this->input->method() == "post"){

            
            $this->form_validation->set_rules('sitename', 'Web site adı', 'trim|required');
            $this->form_validation->set_rules('dnsname', 'DNS Adı', 'trim|required');
            $this->form_validation->set_rules('dnsip', 'DNS IP', 'trim|required');
            //$this->form_validation->set_rules('dnsttl', 'DNS TTL', 'trim|required');
            //$this->form_validation->set_rules('dnsproxy', 'DNS Proxy', 'trim|required');
            
            if ($this->form_validation->run() === FALSE) {

                $data['message'] = "Boş alan bırakmayınız";

            } else {

                $query = $this->common_model->get(['sitekodu' => $this->input->post('sitename',true),'durum'=>1, 'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
                if($query){

                    //print_r($query);
                    $api_key = $this->session->userdata('apikey');
                    $email   = $this->session->userdata('apimail');
                    $zone_id = $query->sitezone;

                    $add = $this->common_model->addata('dnsler',[
                        'type'     =>  strtoupper($this->input->post('dnstype',true)),
                        'name'     =>  $this->input->post('dnsname',true),
                        'content'  =>  $this->input->post('dnsip',true),
                        'ttl'      =>  $this->input->post('dnsttl',true),
                        'proxied'  =>  $this->input->post('dnsproxystatus',true),
                        'priority' =>  intval($this->input->post('dnsproperty',true)),
                        'dnswebsite'=> $this->input->post('sitename',true),
                        'dnsdomain' => $query->sitedomain,
                        'dnsekleyen'=> $this->session->userdata('admincode')  
                    ]);

                    if($add){

                        $lastid = $this->db->insert_id();
                        
                        $data = array(
                            'type'      => strtoupper($this->input->post('dnstype',true)),
                            'name'      => $this->input->post('dnsname',true),
                            'content'   => $this->input->post('dnsip',true),
                            'ttl'       => $this->input->post('dnsttl',true),
                            'proxied'   => boolval($this->input->post('dnsproxystatus',true)),
                            'priority'  => intval($this->input->post('dnsproperty',true))                          
                        );

                        $data_string = json_encode($data);
                        $ch = curl_init("https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records");
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'X-Auth-Email: '.$email,
                            'X-Auth-Key: '.$api_key,
                            'Content-Type: application/json'
                        ));

                        $result     = curl_exec($ch);
                        $jsondecode = json_decode($result);
                        curl_close($ch);

                        //print_r($jsondecode);

                       // print_r($jsondecode);

                        if($jsondecode->success == 1){

                            $data['message'] = "DNS Kaydı eklenmiştir...";
                            $this->common_model->update(['dnsid' => $lastid,'dnsekleyen' => $this->session->userdata('admincode')],['cloudflareip' => $jsondecode->result->id],'dnsler');
                            

                        }else{

                            $data['message'] = $jsondecode->errors[0]->message;

                        }

                    }else{
                        $data['message'] = "Kayıt eklenemedi";
                    }
                    
                }else{
                    $data['message'] = "Web site bulunamadı";
                }

            }

            echo json_encode($data);


        }


    }


}