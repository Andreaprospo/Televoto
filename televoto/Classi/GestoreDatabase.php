<?php
require_once ("Classi/Utente.php");
require_once ("Classi/Votazione.php");
if(!isset($_SESSION)) {
    session_start();
}
class GestoreDatabase {
    
    private static $instance = null;
    private $conn;

    // Configurazione DB
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'televoto';

    // Costruttore privato
    private function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            die("Connessione fallita: " . $this->conn->connect_error);
        }
    }

    // Metodo per ottenere l'istanza
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new GestoreDatabase();
        }
        return self::$instance;
    }

    // Metodo per ottenere la connessione
    private function getConn() {
        return $this->conn;
    }

    public function getUtente($username) {
        $stmt = $this->conn->prepare("SELECT * FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return Utente::parse($result->fetch_assoc());
    }


    public function getVotazione($idVotazione) {
        $stmt = $this->conn->prepare("SELECT * FROM votazioni WHERE idVotazione = ?");
        $stmt->bind_param("i", $idVotazione);
        $stmt->execute();
        $result = $stmt->get_result();
        return Votazione::parse($result->fetch_assoc());
    }

    public function createVotazione($domanda, $idCollegio) 
    {
        $stmt = $this->conn->prepare("INSERT INTO votazioni (domanda,IDcollegio) VALUES (?, ?)");
        $stmt->bind_param("si", $domanda, $idCollegio);
        $stmt->execute();
        return $this->conn->insert_id;
    }   

    public function addVoto($idUtenteVotante, $idVotazione) 
    {
        $stmt = $this->conn->prepare("INSERT INTO partecipazioni (IDutenteVotante, IDvotazione) VALUES (?, ?)");
        $stmt->bind_param("ii", $idUtenteVotante, $idVotazione);
        return $stmt->execute();
    }


    public function getAllVotazioniFromCollegio($idCollegio)
    {
        $stmt = $this->conn->prepare("SELECT * FROM votazioni WHERE idCollegio = ?");
        $stmt->bind_param("i", $idCollegio);
        $stmt->execute();
        $result = $stmt->get_result();
        $votazioni = [];
        while ($row = $result->fetch_assoc()) {
            $votazioni[] = Votazione::parse($row);
        }
        return $votazioni;
    }
    public function getRisposteForDomanda($idVotazione)
    {
        $stmt = $this->conn->prepare("SELECT * FROM risposte WHERE idVotazione = ?");
        $stmt->bind_param("i", $idVotazione);
        $stmt->execute();
        $result = $stmt->get_result();
        $risposte = [];
        while ($row = $result->fetch_assoc()) {
            $risposte[] = $row;
        }
        return $risposte;
    }


    public function createRiposta($risposta, $idVotazione)
    {
        $stmt = $this->conn->prepare("INSERT INTO risposte (risposta,IDvotazione) VALUES (?, ?)");
        $stmt->bind_param("si", $risposta, $idVotazione);
        return $stmt->execute();
    }

    public function changeNumVoti($idVotazione, $numeroRisposta) {
        $numeroRispostaAdattato = $numeroRisposta - 1;
        $stmt = $this->conn->prepare("
            UPDATE risposte
            SET numeroVoti = numeroVoti + 1
            WHERE idrisposta = (
                SELECT idrisposta FROM (
                    SELECT idrisposta
                    FROM risposte
                    WHERE idvotazione = ?
                    ORDER BY idrisposta ASC
                    LIMIT 1 OFFSET ?
                ) AS t
            );

        
        ");
        $stmt->bind_param("ii", $idVotazione, $numeroRispostaAdattato);
        return $stmt->execute();
    }
    
}