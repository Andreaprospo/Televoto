<?php

    class Utente {
        private $id;
        private $username;
        private $privilegio;

        public function __construct($id, $username, $privilegio) {
            $this->id = $id;    
            $this->username = $username;
            $this->privilegio = $privilegio;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPrivilegio() {
            return $this->privilegio;
        }

        public function getId() {
            return $this->id;
        }

        static public function parse($vettoreInfo)
        {
            return new Utente(
                $vettoreInfo["IDutente"],
                $vettoreInfo["username"],
                $vettoreInfo["privilegio"]
            );
        }

    }
?>