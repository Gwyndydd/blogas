<?php

namespace blogapp\controleur;

use blogapp\modele\Billet;
use blogapp\vue\BilletVue;
use blogapp\vue\ListeVue;
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
        /*$nb = $args['nb_billets'];*/
        if($args == null)
            $nb = 2;
        else {
            $nb = $args["nb_billets"];
            $nb_tot = Billet::count();
            if($nb>=$nb_tot){
                $nb = $nb_tot;
            }
        };
        $billets = Billet::orderBy('date','DESC')->limit($nb,0)->get();
        $bl = new BilletVue($this->cont, $billets, BilletVue::LISTE_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }
}
