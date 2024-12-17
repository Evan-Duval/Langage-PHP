<?php 
abstract class Personnage {
    // Propriétés
    protected string $name;
    protected int $vie;
    protected int $initiative;

    // Constructeur 
    public function __construct(string $name, int $vie, int $initiative) {
        $this->name = $name;
        $this->vie = $vie;
        $this->initiative = $initiative;
    }

    // Méthodes

    abstract public function attaquer(string $cible);

    public function afficherInfos(): string {
        return "{$this->name} a {$this->vie} points de vie et {$this->initiative} d'initiative\n";
    }

    public function getName(): string {
        return $this->name;
    }

    public function getVie(): int {
        return $this->vie;
    }

    public function getInitiative(): int {
        return $this->initiative;
    }

    public function afficherGagnant(string $ennemi) {
        if ($this->vie <= 0) {
            echo "Le gagnant est {$ennemi}\n";
        } else {
            echo "Le gagnant est {$this->name}\n";
        }
    }
}
