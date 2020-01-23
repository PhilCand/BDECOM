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

    public function record_count()
    {
       // return $this->db->count_all("bd");
       $query = $this->db->select('COUNT(*) as total')
       ->from($this->get_db_table())       
       ->get();

       foreach ($query->result() as $row) {
           $data[] = $row;
       }
       return $data;
    }

    public function record_count_genre($genre_id)
    {
        $query = $this->db->select('COUNT(*) as total')
            ->from($this->get_db_table())
            ->where("genre_id = $genre_id")
            ->get();

            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
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

    public function getBdById($id){
        $query = $this->db->select('*')
        ->from($this->get_db_table())
        ->where("id = $id")
        ->get();

        return $query->result();
    }

    /**
     * Get the value of _id
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Get the value of _ref
     */
    public function get_ref()
    {
        return $this->_ref;
    }

    /**
     * Set the value of _ref
     *
     * @return  self
     */
    public function set_ref($_ref)
    {
        $this->_ref = $_ref;

        return $this;
    }

    /**
     * Get the value of _titre
     */
    public function get_titre()
    {
        return $this->_titre;
    }

    /**
     * Set the value of _titre
     *
     * @return  self
     */
    public function set_titre($_titre)
    {
        $this->_titre = $_titre;

        return $this;
    }

    /**
     * Get the value of _prix_public
     */
    public function get_prix_public()
    {
        return $this->_prix_public;
    }

    /**
     * Set the value of _prix_public
     *
     * @return  self
     */
    public function set_prix_public($_prix_public)
    {
        $this->_prix_public = $_prix_public;

        return $this;
    }

    /**
     * Get the value of _prix_editeur
     */
    public function get_prix_editeur()
    {
        return $this->_prix_editeur;
    }

    /**
     * Set the value of _prix_editeur
     *
     * @return  self
     */
    public function set_prix_editeur($_prix_editeur)
    {
        $this->_prix_editeur = $_prix_editeur;

        return $this;
    }

    /**
     * Get the value of _ref_editeur
     */
    public function get_ref_editeur()
    {
        return $this->_ref_editeur;
    }

    /**
     * Set the value of _ref_editeur
     *
     * @return  self
     */
    public function set_ref_editeur($_ref_editeur)
    {
        $this->_ref_editeur = $_ref_editeur;

        return $this;
    }

    /**
     * Get the value of _ref_fournisseur
     */
    public function get_ref_fournisseur()
    {
        return $this->_ref_fournisseur;
    }

    /**
     * Set the value of _ref_fournisseur
     *
     * @return  self
     */
    public function set_ref_fournisseur($_ref_fournisseur)
    {
        $this->_ref_fournisseur = $_ref_fournisseur;

        return $this;
    }

    /**
     * Get the value of _resume
     */
    public function get_resume()
    {
        return $this->_resume;
    }

    /**
     * Set the value of _resume
     *
     * @return  self
     */
    public function set_resume($_resume)
    {
        $this->_resume = $_resume;

        return $this;
    }

    /**
     * Get the value of _hero_id
     */
    public function get_hero_id()
    {
        return $this->_hero_id;
    }

    /**
     * Set the value of _hero_id
     *
     * @return  self
     */
    public function set_hero_id($_hero_id)
    {
        $this->_hero_id = $_hero_id;

        return $this;
    }

    /**
     * Get the value of _genre_id
     */
    public function get_genre_id()
    {
        return $this->_genre_id;
    }

    /**
     * Set the value of _genre_id
     *
     * @return  self
     */
    public function set_genre_id($_genre_id)
    {
        $this->_genre_id = $_genre_id;

        return $this;
    }

    /**
     * Get the value of _editeur_id
     */
    public function get_editeur_id()
    {
        return $this->_editeur_id;
    }

    /**
     * Set the value of _editeur_id
     *
     * @return  self
     */
    public function set_editeur_id($_editeur_id)
    {
        $this->_editeur_id = $_editeur_id;

        return $this;
    }

    /**
     * Get the value of _fournisseur_id
     */
    public function get_fournisseur_id()
    {
        return $this->_fournisseur_id;
    }

    /**
     * Set the value of _fournisseur_id
     *
     * @return  self
     */
    public function set_fournisseur_id($_fournisseur_id)
    {
        $this->_fournisseur_id = $_fournisseur_id;

        return $this;
    }

    /**
     * Get the value of _qte
     */ 
    public function get_qte()
    {
        return $this->_qte;
    }

    /**
     * Set the value of _qte
     *
     * @return  self
     */ 
    public function set_qte($_qte)
    {
        $this->_qte = $_qte;

        return $this;
    }

}
