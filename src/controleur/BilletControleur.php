<?php

namespace blogapp\controleur;

use blogapp\modele\Billet;
use blogapp\vue\BilletVue;
use Illuminate\Pagination\Paginator;

class BilletControleur {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function affiche($rq, $rs, $args) {
        $id = $args['id'];
        $billet = Billet::where('id', '=', $id)->first();

        $bl = new BilletVue($this->cont, $billet, BilletVue::BILLET_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function liste($rq, $rs, $args) {
        $billets = Billet::orderBy('date','DESC')->simplePaginate(2);
        /*ajouter composer require illuminate/pagination "~5.0" pour utiliser simplePaginate
        Commentaire juste au cas où problème */

        $bl = new BilletVue($this->cont, $billets, BilletVue::LISTE_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }
}
