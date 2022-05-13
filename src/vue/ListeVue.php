<?php

namespace blogapp\vue;

class ListeVue extends Vue{

    const LISTE_VUE = 1;
    const ADD_VUE = 2;

    public function render(){
        switch($this->selecteur) {
            case self::LISTE_VUE:
                $content = $this->liste();
                break;
            }

        return $this->userPage($content);
    }

    public function liste(){
        $res = "";
        if($this->source != null){
            foreach($this->source as $billet){
                $url = $this->cont->router->pathFor('billet_aff', ['id' => $billet->id]);
                $nbComments = $billet->commentaire()->count();
                $contenu = substr($billet->body,0,30)."...";
                $cat = $billet->categorie->titre;
                $res.= <<<YOP
                <li><a href="$url">{$billet->titre}</a>
        <h4>{$billet->date}</h4>
        <h4>catégorie: $cat</h4>
        <p>$contenu</p>
        <a href="$url" class="btn btn-primary bg-dark" style="width: auto;">See more</a>
YOP;
            }
        $url2 = $this->cont->router->pathFor('billet_liste',['nb_billets' => 4]);
        $res.= '<a href="$url2">Afficher plus</a>';

        /*$res .= <<<YOP
        <div class="row justify-content-center">
            <input type="hidden" id="result_no" value="1">
            <input type="hidden" id="url" value="{$this->baseURL()}">
            <input class="btn btn-primary bg-dark" style="width: auto;" type="button" onclick = "$url2" value="Afficher plus">
        </div>
YOP;*/
        }
        else
            $res="<h1>Erreur : la liste de billets n'existe pas !</h1>";
        return $res;
    }



}


?>