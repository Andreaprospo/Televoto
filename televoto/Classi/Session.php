<?php

require_once("Classi/GestoreDatabase.php");
require_once("Classi/Utente.php");
require_once("Classi/Votazione.php");

    class Session
    {
        public $utenteCorrente;
        public $votazioneCorrente;
        private static $instance;

        public static function getInstance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new Session();
            }
            return self::$instance;
        }

        private function __construct()
        {
            $this->utenteCorrente = null;
            $this->votazioneCorrente = null;
        }

        public function getUtenteCorrente()
        {
            return $this->utenteCorrente;
        }
        public function setUtenteCorrente($utenteCorrente)
        {
            $this->utenteCorrente = $utenteCorrente;
        }
        public function getVotazioneCorrente()
        {
            return $this->votazioneCorrente;
        }
        public function setVotazioneCorrente($votazioneCorrente)
        {
            $this->votazioneCorrente = $votazioneCorrente;
        }

    }



?>