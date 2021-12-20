<?php

class Personnage {
    // ATTRIBUT
    private $_force = 40;
    private $_classe = "Plombier";
    private $_couleurCasquette = "Rouge";
    private $_vie = 100;
    private $_nom = "UNKONW";

    // CONSTRUCTEUR

        public function __construct($nom, $force, $couleur)
        {
            $this->_nom = $nom;
            $this->setForce($force);
            $this->setCouleurClasse($couleur);
        }



    // METHODES
    public function getForce() {
        return $this->_force;
    }
    public function setForce($force) {
        $this->_force = $force;
    }
    public function getCouleurClasse() {
        return $this->_couleurCasquette;
    }
    public function setCouleurClasse($couleur) {
        $this->_couleurCasquette = $couleur;
    }
    public function getClasse() {
        return $this->_classe;
    }

    public function getVie() {
            return $this->_vie;
    }

    public function getInfo() {
            return"<p>".$this->_nom."a une force de ".$this->_force." est de classe ".$this->_classe." et a une cassquette de couleur ".$this->_couleurCasquette.".</p>";
    }

    public function frapper(Personnage $personnage){
            return $personnage->recevoirDegats($this->_force);
    }

    public function recevoirDegats($force) {
            $this->_vie = $this->_vie - $force;

            if($this->_vie <= 0) {
                echo "<p>".$this->_nom." a perdu ".$force." points de vie. Il vient de succomber de ses blessures. </p>";
            } else{

                echo "<p>".$this->_nom." a perdu ".$force." points de vie. Il lui reste ".$this->_vie." points. </p>";
            }
    }

}

$mario = new Personnage("MARIO", 45, "rouge");
$luigi = new Personnage("LUIGI", 40, "verte");

function choix(){
    return rand(0,1);
}

do {

    if($mario->getVie()<=0 || $luigi->getVie()<=0) {
        exit();
    }

    $perso = choix();
    if($perso == 0){
        $mario->frapper($luigi);
    } else {
        $luigi->frapper($mario);
    }

    $mario->getInfo();
    $luigi->getInfo();

} while($mario->getVie()>0 || $luigi->getVie()>0);




