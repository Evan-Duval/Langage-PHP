<?php
require_once "Personnage.php";

class Mage extends Personnage {
    // Propriétés
    private int $magie;
    protected int $vie;

    // Construction 
    public function __construct(string $name, string $classe) {
        parent::__construct($name, $classe);
        $this->magie = rand(1, 20);
        $this->vie = 80;
    }

    // Méthodes

    public function afficherInfos(): string {
        return parent::afficherInfos() . "et {$this->magie} de magie.\n";
    }

    public function attaquer($cible): string {
        $reussiteAttaque = rand(1, 100);
        if ($reussiteAttaque <= 10) {
            return "{$this->name} tente d'attaquer {$cible->name}, mais il rate son coup\n";
        }

        if ($reussiteAttaque >= 80) {
            $degats = $this->magie * 2;
            $cible->vie = ($cible->vie - $degats > 0) ? $cible->vie - $degats : 0 ;
            return "{$this->name} attaque {$cible->name} d'un coup critique lui infligeant {$degats} points de vie. Il a maintenant {$cible->vie} points de vie\n";

        } 
        $degats = $this->magie;
        $cible->vie = ($cible->vie - $degats > 0) ? $cible->vie - $degats : 0 ;

        return "{$this->name} attaque {$cible->name} lui infligeant {$degats} points de vie. Il a maintenant {$cible->vie} points de vie\n";
    }

}