<?php
class Utente
{
    // Proprietà private
    public $nomeUtente;
    private $isAdmin;
    private $isPrivilegiato;

    // Costruttore per inizializzare le proprietà
    public function __construct($nome, $privilegio)
    {
        $this->nomeUtente = $nome;
        if ($privilegio == "A") {
            $this->isAdmin = true;
            $this->isPrivilegiato = false;
            return;
        }
        if ($privilegio == "P") {
            $this->isAdmin = false;
            $this->isPrivilegiato = true;
            return;
        }
        if($privilegio =="P+A"){
            $this->isAdmin = true;
            $this->isPrivilegiato = true;
            return;
        }

        $this->isAdmin = false;
        $this->isPrivilegiato = false;
        return;
    }

    // Getter per $nomeUtente
    public function getNomeUtente() {
        return $this->nomeUtente;
    }

    // Getter per $isAdmin
    public function getIsAdmin() {
        return $this->isAdmin;
    }

    // Getter per $isPrivilegiato
    public function getIsPrivilegiato() {
        return $this->isPrivilegiato;
    }
}
?>