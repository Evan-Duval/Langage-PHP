<?php 
abstract class Personnage {
    // Propriétés
    protected string $name;
    protected string $classe;
    protected int $initiative;
    protected int $vie;

    // Constructeur 
    public function __construct(string $name, string $classe) {
        $this->name = $name;
        $this->classe = $classe;
        $this->initiative = rand(1, 100);
    }

    // Méthodes
    abstract public function attaquer(string $cible);

    public function afficherInfos(): string {
        return "\n{$this->name} ({$this->classe}) a {$this->vie} points de vie, {$this->initiative} d'initiative\n";
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
