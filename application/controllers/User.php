<?php 

class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
       
    }

    

    public function profile(){
        ##giriş varsa ana sayfaya gönder
        if($this->session->userdata('login') != sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url('user/login'));
        }
        $viewData = array(
            "setting" => $this->common_model->get(['id' => 1],'ayarlar')
        );
        $this->load->view('profile_view',$viewData);
    }

    public function profiledata(){

        if($this->session->userdata('login') != sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url('user/login'));
        }
   

        if($this->input->method() == "post"){

          

            $this->form_validation->set_rules('kadi', 'Kullanıcı Adı', 'trim|required');
            $this->form_validation->set_rules('email', 'E-posta', 'trim|required|valid_email');
            $this->form_validation->set_rules('apikey', 'Api Key', 'trim|required');
            $this->form_validation->set_rules('apimail', 'Api Mail', 'trim|required');
            $this->form_validation->set_rules('apiorganizasyon', 'Api Organizasyon', 'trim|required');
            

            if ($this->form_validation->run() === FALSE) {
                echo "empty";
            }else {

                $query = $this->common_model->getAll(['adminposta' => $this->input->post('email',true),'adminkodu !=' => $this->session->userdata('admincode')],'admin','adminid','DESC');
                if($query){
                    echo 'allready';
                }else{

                    if($this->input->post('pass',true) == ""){

                        $data = array(
                            'adminkadi'         => $this->input->post('kadi',true),
                            'adminposta'        => $this->input->post('email',true),
                            'apikey'            => $this->input->post('apikey',true),
                            'apimail'           => $this->input->post('apimail',true),
                            'apiorganizasyon'   => $this->input->post('apiorganizasyon',true)
                        );

                    }else{

                        $data = array(
                            'adminkadi'         => $this->input->post('kadi',true),
                            'adminposta'        => $this->input->post('email',true),
                            'apikey'            => $this->input->post('apikey',true),
                            'apimail'           => $this->input->post('apimail',true),
                            'apiorganizasyon'   => $this->input->post('apiorganizasyon',true),
                            'adminsifre'        => sha1(md5($this->input->post('pass',true)))
                        );

                    }


                    $up = $this->common_model->update(['adminkodu' => $this->session->userdata('admincode')],$data,'admin');
                    if($up){

                        $this->session->set_userdata([ 
                        
                            'adminkadi'      => $this->input->post('kadi',true),
                            'adminmail'      => $this->input->post('email',true),
                            'apikey'         => $this->input->post('apikey',true),
                            'apimail'        => $this->input->post('apimail',true),
                            'apiorganizasyon'=> $this->input->post('apiorganizasyon',true)
                            
                        ]);

                        echo 'ok';
                    }else{
                        echo 'error';
                    }

                  

                }

            }

        }


    }

    public function login(){
        ##giriş varsa ana sayfaya gönder
        if($this->session->userdata('login') == sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url());
        }
        $viewData = array(
            "setting" => $this->common_model->get(['id' => 1],'ayarlar')
        );
        $this->load->view('login_view',$viewData);
    }

    public function register(){
        ##giriş varsa ana sayfaya gönder
        if($this->session->userdata('login') == sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url());
        }
        $viewData = array(
            "setting" => $this->common_model->get(['id' => 1],'ayarlar')
        );
        $this->load->view('register_view',$viewData);
    }


    public function registerdata(){

        ##giriş varsa ana sayfaya gönder
        if($this->session->userdata('login') == sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url());
        }

        if($this->input->method() == "post"){

            $this->form_validation->set_rules('email', 'E-posta', 'trim|required|valid_email');
            $this->form_validation->set_rules('kadi', 'Kullanıcı Adı', 'trim|required');
            $this->form_validation->set_rules('apikey', 'Api Key', 'trim|required');
            $this->form_validation->set_rules('apimail', 'Api Mail', 'trim|required');
            $this->form_validation->set_rules('apiorganizasyon', 'Api Organizasyon', 'trim|required');
            $this->form_validation->set_rules('pass', 'Parola', 'trim|required');
            $admincode = uniqid('bcysoftware_');
            
            if ($this->form_validation->run() === FALSE) {
                echo "empty";
            }else {

                $query = $this->common_model->getAll(['adminposta' => $this->input->post('email',true)],'admin','adminid','DESC');
                if($query){
                    echo 'allready';
                }else{

                    $add = $this->common_model->addata('admin',[
                        'adminkadi'         => $this->input->post('kadi',true),
                        'adminposta'        => $this->input->post('email',true),
                        'adminkodu'         => $admincode,
                        'adminekleyen'      => $admincode,
                        'adminyetki'        => 1,
                        'apikey'            => $this->input->post('apikey',true),
                        'apimail'           => $this->input->post('apimail',true),
                        'apiorganizasyon'   => $this->input->post('apiorganizasyon',true),
                        'adminsifre'        => sha1(md5($this->input->post('pass',true))),
                    ]);

                    if($add){

                        $this->common_model->addata('loglar',[
                            'logbaslik'   => 'Kayıt olundu',
                            'logaciklama' => 'Kayıt olundu',
                            'logekleyen'  => $admincode,
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

    public function logindata(){

        ##giriş varsa ana sayfaya gönder
        if($this->session->userdata('login') == sha1(md5(IP() . $this->session->userdata('adminid') . tar())) ) {
            redirect(base_url());
        }

        if($this->input->method() == "post"){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'E-posta', 'trim|required|valid_email');
            $this->form_validation->set_rules('pass', 'Parola', 'trim|required');
            if($this->form_validation->run() === FALSE){

                echo "empty";

            }else{


                $data = array(
                    'adminposta'=>strip_tags($this->input->post('email',true)),
                    'adminsifre' =>sha1(md5(strip_tags($this->input->post('pass',true))))
                );

                $query = $this->common_model->get($data,'admin');
                if($query){

                    if($query->admindurum == 1){

                        $generator = IP().$query->adminid.tar();
                        $loginok = sha1(md5($generator));
 
                        $this->session->set_userdata([ 
                            'login'         => $loginok,
                            'adminid'       => $query->adminid,
                            'adminkadi'     => $query->adminkadi,
                            'adminmail'     => $query->adminposta,
                            'adminstatus'   => $query->admindurum,
                            'adminauth'     => $query->adminyetki,
                            'admincode'     => $query->adminkodu,
                            'adminadd'      => $query->ekleme,
                            'adminedit'     => $query->duzenleme,
                            'admindelete'   => $query->silme,
                            'adminlist'     => $query->listeleme, 
                            'apikey'        => $query->apikey,
                            'apimail'       => $query->apimail,
                            'apiorganizasyon'=> $query->apiorganizasyon,
                            
                        ]);

                        $this->common_model->addata('loglar',[
                            'logbaslik'   => 'Üye girişi',
                            'logaciklama' => 'Üye girişi yapıldı',
                            'logekleyen'  => $query->adminkodu,
                            'logip'       => $this->input->ip_address()
                        ]);

                        echo "ok";



                    }else{
                        echo "passive";
                    }

                }else{
                    echo "error";
                }


            }


        }

    }



    public function logout(){
        
        $this->session->sess_destroy();
        redirect(base_url('user/login'));
        
    }


}

?>