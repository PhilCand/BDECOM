<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panier extends CI_Controller
{
    public function index()
    {
        $this->load->library('table');
        $data['contents'] = 'vue_panier';
        $this->load->view('templates/template', $data);
    }

    public function ajouterPanier($id)
    {
        $bd = ($this->Bande_dessinee->getBdById($id)[0]);

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $bd->qte = 1;
            array_push($_SESSION['panier'], $bd);
        } else {
            $trouve = false;
            foreach ($_SESSION['panier'] as $bd_panier) {
                if ($bd_panier->id == $id) {
                    $bd_panier->qte++;
                    $trouve = true;
                }
            }
            if ($trouve == false) {
                $bd->qte = 1;
                array_push($_SESSION['panier'], $bd);
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function retirerPanier($id)
    {
        foreach ($_SESSION['panier'] as $key => $bd_panier) {
            if ($bd_panier->id == $id) {
                $bd_panier->qte--;
                if ($bd_panier->qte <= 0) {
                    unset($_SESSION['panier'][$key]);
                }
            }
        }

        if (count($_SESSION['panier']) == 0) {
            unset($_SESSION['panier']);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function supprimerDuPanier($id)
    {
        foreach ($_SESSION['panier'] as $key => $bd_panier) {
            if ($bd_panier->id == $id) {
                unset($_SESSION['panier'][$key]);
            }
        }

        if (count($_SESSION['panier']) == 0) {
            unset($_SESSION['panier']);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function clearPanier()
    {
        unset($_SESSION['panier']);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
