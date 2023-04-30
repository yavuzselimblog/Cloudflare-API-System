<?php
/**
 * Created by PhpStorm.
 * User: yavuzselim
 * Date: 29.10.2019
 * Time: 20:45
 */

 

function customerchecksession()
{
    $ci = &get_instance();
    
    if($ci->session->userdata('login') == sha1(md5(IP() . $ci->session->userdata('adminid') . tar()))) {

        $data = array(
            "adminid" => $ci->session->userdata('adminid')
        );

        $query = $ci->common_model->get($data,'admin');
        if($query->admindurum == 1){

            $generator = IP().$query->adminid.tar();
            $loginok = sha1(md5($generator));
 
            $ci->session->set_userdata([

                'login' => $loginok

            ]);

        } else {
            $ci->session->sess_destroy();
            redirect(base_url('user/login'));
        }

    }else{
        $ci->session->sess_destroy();
        redirect(base_url('user/login'));
    }
}


?>