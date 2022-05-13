<?php

namespace blogapp\modele;

class membres extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'membres';
    protected $primaryKey = 'id_membre';
    public $timestamps = false;

    /*public function membre() {
        return $this->belongsTo('\blogapp\modele\Categorie', 'cat_id');
    }*/
}

?>