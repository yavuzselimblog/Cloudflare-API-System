<?php 

class Website extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('customer_session');
        customerchecksession();
       
    }

    public function index(){
        redirect(base_url('website/list'));
    }


    public function multiadd(){

        if(count($this->input->post('website')) < 1){
            echo 'empty';
        }else{

            if(count($this->input->post('website')) > 10){

                echo "max";
    
            }else{
    
                foreach($this->input->post('website') as $row){
    
                    $query = $this->common_model->getAll(['sitedomain' => $row],'websiteler','siteid','DESC');
                    if(count($query) < 1){
    
    
                        $data = array(
                            "sitekodu"    => uniqid("bcysoftware_"),
                            "siteadi"     => $row,
                            "sitedomain"  => $row,
                            "siteip"      => $this->input->ip_address(),
                            "siteekleyen" => $this->session->userdata('admincode')
                        );
    
                        $add = $this->common_model->addata('websiteler',$data);
                        //print_r($_SESSION);
                        $lastid  = $this->db->insert_id();
                        $api_key = $this->session->userdata('apikey');
                        $email   = $this->session->userdata('apimail');
    
                        // Eklemek istediğiniz alan adı
                        $domain_name = $row;
    
                        // API çağrısı için gerekli parametreleri oluşturun
                        $data = array(
                            "name" => $domain_name,
                            "account" => array(
                                "id" => $lastid
                            ),
                            "jump_start" => true,
                            "type" => "full",
                            "organization" => array(
                                "id" => $this->session->userdata('apiorganizasyon')
                            ),
                            "paused" => false
                        );
    
                        // Cloudflare API'yi çağırmak için cURL kullanın
                        $ch = curl_init("https://api.cloudflare.com/client/v4/zones");
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            "X-Auth-Email: " . $email,
                            "X-Auth-Key: " . $api_key,
                            "Content-Type: application/json"
                        ));
    
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        $result = json_decode($response, true);
    
                        //print_r($result);
    
                        $zone_id = $result["result"]["id"];
                        $this->common_model->update(['siteid'=>$lastid, 'siteekleyen' => $this->session->userdata('admincode')],['sitezone'=>$zone_id],'websiteler');
    
                    }
                    
    
                }
    
                if($add){
                    $this->common_model->addata('loglar',[
                        'logbaslik'   => 'Toplu Web Site Eklendi',
                        'logaciklama' => "Toplu domain ekledi",
                        'logekleyen'  => $this->session->userdata('admincode'),
                        'logip'       => $this->input->ip_address()
                    ]);
                    echo 'ok';
                }else{
                    echo "error";
                }
    
            }

        }

    }



    public function delete($id){

        if(!$id){
            redirect(base_url());
        }

        $dnsquery = $this->common_model->get(['sitekodu' => $id,'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
        if($dnsquery){

            $api_key      = $this->session->userdata('apikey');
            $email        = $this->session->userdata('apimail');
            $zone_id      = $dnsquery->sitezone;

            // Cloudflare API'sini çağırarak etki alanını silin
            $url = "https://api.cloudflare.com/client/v4/zones/{$zone_id}";
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

            $this->common_model->delete(['sitekodu' => $id,'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
            $this->common_model->delete(['dnsdomain' => $dnsquery->sitedomain,'dnsekleyen' => $this->session->userdata('admincode')],'dnsler');
            redirect(base_url('website/list'));

        }else{
            redirect(base_url());
        }

    }


    public function editform($id){
        if(!$id){
            redirect(base_url());
        }

        $query = $this->common_model->get(['sitekodu' => $id,'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
        if($query){

            $viewData = array(
                "setting"  => $this->common_model->get(['id'=>1],'ayarlar'),
                "detail"   => $query,
            );
            $this->load->view('editsite_view',$viewData);

        }else{
            redirect(base_url());
        }
    } 

    public function new(){

        $viewData = array(
			"setting"  => $this->common_model->get(['id'=>1],'ayarlar'),
		);
		$this->load->view('newsite_view',$viewData);

    }


    public function multinew(){

        $viewData = array(
			"setting"  => $this->common_model->get(['id'=>1],'ayarlar'),
		);
		$this->load->view('multinewsite_view',$viewData);

    }

    public function list(){

        $perPage = 20;
        $pageSegment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $links = paginationHelper(base_url('website/list/'),
            $this->common_model->getcount(['siteekleyen' => $this->session->userdata('admincode')], 'websiteler'),
            $perPage, 3, TRUE, []);

        $query = $this->common_model->get(['id' => 1],'ayarlar');
        $viewData  = array(

            "setting"       => $query,           
            "websitelist"   => $this->common_model->getlimit(['siteekleyen' => $this->session->userdata('admincode')], $perPage, ($pageSegment - 1) * $perPage, 'websiteler','siteid','DESC'),
            "websitelinks"  => $links,
            "websitecount"  => $this->common_model->getcount(['siteekleyen' => $this->session->userdata('admincode')], 'websiteler')
            
        );
        $this->load->view('list_view',$viewData);

    }


    public function dnslist($id){

        if(!$id){
            redirect(base_url());
        }

        $query = $this->common_model->get(['sitekodu' => $id,'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
        if($query){
            
            $viewData  = array(

                "setting"       => $this->common_model->get(['id' => 1],'ayarlar'),
                "websitename"   => $query,
                "dnslist"       => $this->common_model->getAll(['dnswebsite' => $query->sitekodu,'dnsekleyen' => $this->session->userdata('admincode')],'dnsler','dnsid','DESC')
                
            );
            $this->load->view('websitedns_view',$viewData);


        }else{
            redirect(base_url("website/list"));
        }

    }


    public function newdata(){

        if($this->input->method() == "post"){

            
            $this->form_validation->set_rules('sitename', 'Web site adı', 'trim|required');
            $this->form_validation->set_rules('domain', 'Web site domain', 'trim|required');
            
            if ($this->form_validation->run() === FALSE) {
                echo 'empty';
            } else {

                $query = $this->common_model->getAll(['sitedomain' => $this->input->post('domain',true)],'websiteler','siteid','DESC');
                if($query){
                    echo 'allready';
                }else{


                    $data = array(
                        "sitekodu"    => uniqid("bcysoftware_"),
                        "siteadi"     => $this->input->post('sitename',true),
                        "sitedomain"  => $this->input->post('domain',true),
                        "siteip"      => $this->input->ip_address(),
                        "siteekleyen" => $this->session->userdata('admincode')
                    );

                    $add = $this->common_model->addata('websiteler',$data);
                    if($add){

                        //print_r($_SESSION);
                        $lastid  = $this->db->insert_id();
                        $api_key = $this->session->userdata('apikey');
                        $email   = $this->session->userdata('apimail');

                        // Eklemek istediğiniz alan adı
                        $domain_name = $this->input->post('domain',true);

                        // API çağrısı için gerekli parametreleri oluşturun
                        $data = array(
                            "name" => $domain_name,
                            "account" => array(
                                "id" => $lastid
                            ),
                            "jump_start" => true,
                            "type" => "full",
                            "organization" => array(
                                "id" => $this->session->userdata('apiorganizasyon')
                            ),
                            "paused" => false
                        );

                        // Cloudflare API'yi çağırmak için cURL kullanın
                        $ch = curl_init("https://api.cloudflare.com/client/v4/zones");
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            "X-Auth-Email: " . $email,
                            "X-Auth-Key: " . $api_key,
                            "Content-Type: application/json"
                        ));

                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        $result = json_decode($response, true);

                        //print_r($result);

                        $zone_id = $result["result"]["id"];
                        $this->common_model->update(['siteid'=>$lastid,'siteekleyen' => $this->session->userdata('admincode')],['sitezone'=>$zone_id],'websiteler');


                        $this->common_model->addata('loglar',[
                            'logbaslik'   => 'Web Site Eklendi',
                            'logaciklama' => $this->input->post('domain',true)." adlı domain ekledi",
                            'logekleyen'  => $this->session->userdata('admincode'),
                            'logip'       => $this->input->ip_address()
                        ]);

                        echo 'ok';


                    }else{
                        echo 'error';
                    }



                }

            }
            
            

        }

    }






    public function editformdata(){

        if($this->input->method() == "post"){

            
            $this->form_validation->set_rules('sitename', 'Web site adı', 'trim|required');
            $this->form_validation->set_rules('domain', 'Web site domain', 'trim|required');
            $this->form_validation->set_rules('sitecode', 'Web site kodu', 'trim|required');
            $this->form_validation->set_rules('status', 'Web site durum', 'trim|required');
            
            if ($this->form_validation->run() === FALSE) {
                echo 'empty';
            } else {

                $query = $this->common_model->getAll(['sitedomain' => $this->input->post('domain',true), 'sitekodu !=' => $this->input->post('sitecode',true),'siteekleyen' => $this->session->userdata('admincode')],'websiteler','siteid','DESC');
                if($query){
                    echo 'allready';
                }else{


                    $data = array(
                       
                        "siteadi"     => $this->input->post('sitename',true),
                        "sitedomain"  => $this->input->post('domain',true),
                        "durum"       => $this->input->post('status',true),
                    );

                    $upp = $this->common_model->update(['sitekodu'=>$this->input->post('sitecode',true),'siteekleyen' => $this->session->userdata('admincode')],$data,'websiteler');
                    if($upp){

                    

                        $websitequery = $this->common_model->get(['sitekodu' => $this->input->post('sitecode',true),'siteekleyen' => $this->session->userdata('admincode')],'websiteler');
                        $api_key      = $this->session->userdata('apikey');
                        $email        = $this->session->userdata('apimail');
                        $zone_id      = $websitequery->sitezone;

                        $new_name = $this->input->post('domain',true);
                        $data = json_encode(array(
                            "name" => $new_name
                        ));

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.cloudflare.com/client/v4/zones/{$zone_id}",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "PUT",
                            CURLOPT_POSTFIELDS => $data,
                            CURLOPT_HTTPHEADER => array(
                                "X-Auth-Email: {$email}",
                                "X-Auth-Key: {$api_key}",
                                "Content-Type: application/json"
                            ),
                        ));
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        
                        curl_close($curl);
                        
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            echo $response;
                        }

                        $this->common_model->addata('loglar',[
                            'logbaslik'   => 'Web Site Güncellendi',
                            'logaciklama' => $this->input->post('sitecode',true)." adlı site güncellendi",
                            'logekleyen'  => $this->session->userdata('admincode'),
                            'logip'       => $this->input->ip_address()
                        ]);

                        echo 'ok';


                    }else{
                        echo 'error';
                    }



                }

            }
            
            

        }

    }



}

?>