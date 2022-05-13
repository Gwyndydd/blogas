<?php

namespace blogapp\modele;

class Commentaires extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'commentaires';
    protected $primaryKey = 'id_com';
    public $timestamps = false;

}

?>