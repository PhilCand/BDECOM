<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magasin extends CI_Controller
{

    public function index()
    {

        $this->load->helper('url');
        $this->load->library('pagination');

        $config = array();
        $config['base_url'] = base_url() . 'Magasin/index';
        $config['total_rows'] = $this->Bande_dessinee->record_count();
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination pagination-centered">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if(isset($_POST['genres'])){
            $data["results"] = $this->Bande_dessinee->get_data_bd($config['per_page'], $page, $_POST['genres']);
        }

        else{
            $data["results"] = $this->Bande_dessinee->get_data_bd($config['per_page'], $page, -1);
        }
        

        $data["links"] = $this->pagination->create_links();

        echo $_POST['genres'];

        //________________________________

        $data["genres"] = $this->Genre->get_data(); 

        $data['contents'] = 'vue_magasin';

        $this->load->view('templates/template', $data);
    }
}
