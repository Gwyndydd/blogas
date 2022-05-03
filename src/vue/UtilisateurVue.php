<?php

namespace blogapp\vue;

use blogapp\vue\Vue;

class UtilisateurVue extends Vue {
    const NOUVEAU_VUE = 1;
    
    public function render() {
        switch($this->selecteur) {
        case self::NOUVEAU_VUE:
            $content = $this->nouveau();
            break;
        }
        return $this->userPage($content);
    }

    public function nouveau() {
        return <<<YOP
        <form method="post" action="{$this->cont['router']->pathFor('util_cree')}">
            <label for="user_nom">Nom :</label> <input type="text" id="nom" name="user_nom">
            <label for="user_prenom">Prénom :</label><input type="text" name="user_prenom">
            <label for="user_pseudo">Pseudo :</label><input type="text" name="user_pseudo">
            <label for="user_mdp">Mot de passe :</label><input type="password" name="user_mdp">
            <label for="user_email">email:</label><input type="text" name="user_email">
            <input type="submit" value="OK">
        </form>
YOP;
    }
}
