<?php

namespace blogapp\vue;
use blogapp\vue\Vue;

class BilletVue extends Vue {
    const BILLET_VUE = 1;
    const LISTE_VUE = 2;
    
    public function render() {
        switch($this->selecteur) {
        case self::BILLET_VUE:
            $content = $this->billet();
            break;
        case self::LISTE_VUE:
            $content = $this->liste();
            break;
        }
        return $this->userPage($content);
    }

    public function billet() {
        $res = "";

        if ($this->source != null) {
            $res = <<<YOP
    <h1>Affichage du billet : {$this->source->id}</h1>
    <h2>Nom : {$this->source->titre}</h2>
    <h3>{$this->source->date}</h3>
    <ul>
        <li>Catégorie : {$this->source->categorie->titre}</li>
        <li>Contenu : {$this->source->body}</li>
    </ul>
    <h3>Commentaires :</h3>
    <ul>
    YOP;
            
            $com = $this->source->commentaire;
            $count = 0;
            foreach($com as $com){
                $count += 1;
                $res .= <<< YOP
        <li>
            <h4>date : {$com->DateCom}</h4>
            <p>{$com->contenu}</p>
        </li>
    YOP;
                }
            if($count == 0){
            $res.="<h4>Aucun commentaire<h4>";
            }
        $res .= "</ul>";

        }
        else
            $res = "<h1>Erreur : le billet n'existe pas !</h1>";

        return $res;
    }

    public function liste() {
        $res = "";
        
        if ($this->source != null) {
            $res = <<<YOP
    <h1>Affichage de la liste des billets</h1>
    <ul>
YOP;        $coll = $this->source->forPage(2,1);
            foreach ($this->source as $billet) {
                $url = $this->cont->router->pathFor('billet_aff', ['id' => $billet->id]);
                $res .= <<<YOP
        <li><a href="$url">{$billet->titre}</a>
        <h4>{$billet->date}</h4>
        <h4>catégorie: {$billet->categorie->titre}</h4>
        <p>
YOP;
        $res.= substr($billet->body,0,30)."..."."</p>.</li>";

            }
            $res .= <<<YOP
            </ul>
                <h5>Pagination</h5>
                {{$this->source->links()}}
YOP;
        }
        else
            $res = "<h1>Erreur : la liste de billets n'existe pas !</h1>";

        return $res;
    }


}
