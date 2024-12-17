<?php

require_once "Personnage.php";

class Guerrier extends Personnage {
    // Propriétés
    private int $force;
    private int $vie;

    // Constructeur

    public function __construct(string $name, int $vie, int $initiative, int $force) {
        parent::__construct( $name, $vie, $initiative);
        $this->force = $force;
    }

    // Méthodes

    public function afficherInfos(): string {
        return parent::afficherInfos() . "et {$this->force} de force\n";
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