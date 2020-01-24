<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magasin extends CI_Controller
{
    public function index()
    {
        $this->load->helper('url');
        $this->load->library('pagination');

        //verif du type de recherche
        if (isset($_SESSION['genre']) && isset($_POST['genres'])) {
            if ($_SESSION['genre'] != $_POST['genres']) {
                unset($_SESSION['genre']);
            }
        }

        if (isset($_POST['genres'])) {
            $_SESSION['genre'] = $_POST['genres'];
            unset($_SESSION['recherche']);
        }

        if (isset($_POST['recherche'])) {
            $_SESSION['recherche'] = $_POST['recherche'];
            unset($_SESSION['genre']);
        }

        //calcul du total de tuple renvoyé pour connaitre le nombre de pages
        if (isset($_SESSION['genre'])) {
            $total_tuple = $this->Bande_dessinee->get_data_bd(10000, 0, $_SESSION['genre']);
        } else if (isset($_SESSION['recherche'])) {
            $total_tuple = $this->Bande_dessinee->get_data_bd_recherche(10000, 0, $_SESSION['recherche']);
        } else {
            $total_tuple = $this->Bande_dessinee->get_data_bd(10000, 0, -1);
        }

        //config de la pagination
        $config = array();
        $config['base_url'] = base_url() . 'Magasin/index';
        $config['total_rows'] = count($total_tuple);
        $config['per_page'] = 18;
        $config["uri_segment"] = 3;
        //config pagination bootstrap
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

        //execution de la requete en fonction de la recherche
        $data["results"] = "";
        if (isset($_SESSION['genre'])) {
            $data["results"] = $this->Bande_dessinee->get_data_bd($config['per_page'], $page, $_SESSION['genre']);
        } else if (isset($_SESSION['recherche'])) {
            $data["results"] = $this->Bande_dessinee->get_data_bd_recherche($config['per_page'], $page, $_SESSION['recherche']);
        } else {
            $data["results"] = $this->Bande_dessinee->get_data_bd($config['per_page'], $page, -1);
        }

        $data["links"] = $this->pagination->create_links();
        $data["genres"] = $this->Genre->get_data();
        $data['contents'] = 'vue_magasin';

        $this->load->view('templates/template', $data);
    }

    public function clearSearch()
    {
        unset($_SESSION['genre']);
        unset($_SESSION['recherche']);
        redirect('Magasin/index');
    }
}
