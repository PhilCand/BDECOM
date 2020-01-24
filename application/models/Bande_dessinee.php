<?php
class Bande_dessinee extends MY_model
{
    private $_id;
    private $_ref;
    private $_titre;
    private $_prix_public;
    private $_prix_editeur;
    private $_ref_editeur;
    private $_ref_fournisseur;
    private $_resume;
    private $_hero_id;
    private $_genre_id;
    private $_editeur_id;
    private $_fournisseur_id;
    private $_qte;
    private $_nom_editeur;
    private $_nom_auteur;

    public function get_db_table()
    {
        return 'bd';
    }

    public function get_db_table_pk()
    {
        return 'id';
    }

    public function get_data_bd($limit, $start, $id_genre)
    {

        if ($id_genre == -1) {
            $query =  $this->db->select('bd.*, editeur.nom as nom_editeur, GROUP_CONCAT(auteur.nom SEPARATOR ", ") as nom_auteur')
                ->from($this->get_db_table())
                ->join('editeur','bd.editeur_id = editeur.id') 
                ->join('auteur_bd','bd.id = auteur_bd.bd_id')
                ->join('auteur','auteur.id = auteur_bd.auteur_id', 'left')
                ->group_by('bd.id')
                ->limit($limit, $start)
                ->get();
                
        } else {
            $query =  $this->db->select('bd.*, editeur.nom as nom_editeur, GROUP_CONCAT(auteur.nom SEPARATOR ", ") as nom_auteur')
                ->from($this->get_db_table())
                ->join('editeur','bd.editeur_id = editeur.id') 
                ->join('auteur_bd','bd.id = auteur_bd.bd_id')
                ->join('auteur','auteur.id = auteur_bd.auteur_id', 'left')
                ->where("genre_id = $id_genre")
                ->group_by('bd.id')
                ->limit($limit, $start)
                ->get();
        }

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_data_bd_recherche($limit, $start, $recherche){

        $query =  $this->db->select('bd.*, hero.nom as nom_hero, editeur.nom as nom_editeur, GROUP_CONCAT(auteur.nom SEPARATOR ", ") as nom_auteur')
            ->from($this->get_db_table())
            ->join('editeur','bd.editeur_id = editeur.id') 
            ->join('auteur_bd','bd.id = auteur_bd.bd_id')
            ->join('hero','hero.id = bd.hero_id', 'left')
            ->join('auteur','auteur.id = auteur_bd.auteur_id', 'left')
            ->where("hero.nom like '%$recherche%' or bd.titre like '%$recherche%' or bd.ref like '%$recherche%' or bd.resume like '%$recherche%' or editeur.nom like '%$recherche%' or auteur.nom like '%$recherche%'")
            ->group_by('bd.id')
            ->limit($limit, $start)
            ->get();

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
    }    

    public function getBdById($id){
        $query = $this->db->select('*')
        ->from($this->get_db_table())
        ->where("id = $id")
        ->get();

        return $query->result();
    }
}