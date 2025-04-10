<?php

    class Votazione
    {
        private $idVotazione;
        private $domanda;
        private $idCollegio;

        public function __construct($idVotazione, $domanda, $idCollegio)
        {
            $this->idVotazione = $idVotazione;
            $this->domanda = $domanda;
            $this->idCollegio = $idCollegio;
        }

        static public function parse($vettoreInfo)
        {
            return new Votazione(
                $vettoreInfo["IDvotazione"],
                $vettoreInfo["domanda"],
                $vettoreInfo["IDcollegio"]
            );
        }

        public function getIdVotazione()
        {
            return $this->idVotazione;
        }
        public function getDomanda()
        {
            return $this->domanda;
        }
        public function getIdCollegio()
        {
            return $this->idCollegio;
        }
    }
?>