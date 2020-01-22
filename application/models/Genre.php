<?php

class Genre extends MY_model{

    private $_id;
    private $_nom;

    public function get_db_table()
    {
     return 'genre';   
    }

    public function get_db_table_pk()
    {
        return 'genre';
    }


}

