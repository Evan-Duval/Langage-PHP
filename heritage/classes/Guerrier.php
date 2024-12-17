<?php

require_once "Personnage.php";

class Guerrier extends Personnage {
    // Propriétés
    private int $force;
    protected int $vie;

    // Constructeur

    public function __construct(string $name, string $classe) {
        parent::__construct( $name, $classe);
        $this->force = rand(1, 20);
        $this->vie = 120;
    }

    // Méthodes

    public function afficherInfos(): string {
        return parent::afficherInfos() . "et {$this->force} de force.\n";
    }

    public function attaquer($cible): string {
        $reussiteAttaque = rand(1, 100);
        if ($reussiteAttaque <= 10) {
            return "{$this->name} tente d'attaquer {$cible->name}, mais il rate son coup\n";
        }

        if ($reussiteAttaque >= 80) {
            $degats = $this->force * 2;
            $cible->vie = ($cible->vie - $degats > 0) ? $cible->vie - $degats : 0 ;
            return "{$this->name} attaque {$cible->name} d'un coup critique lui infligeant {$degats} points de vie. Il a maintenant {$cible->vie} points de vie\n";

        } 
        $degats = $this->force;
        $cible->vie = ($cible->vie - $degats > 0) ? $cible->vie - $degats : 0 ;
        return "{$this->name} attaque {$cible->name} lui infligeant {$degats} points de vie. Il a maintenant {$cible->vie} points de vie\n";
    }

}