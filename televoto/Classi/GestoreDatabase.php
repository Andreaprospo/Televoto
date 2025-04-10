<?php

    require_once ("Classi/Utente.php");
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


    public function getVotazioni($idUtente) {
        $stmt = $this->conn->prepare("SELECT * FROM votazioni WHERE idUtente = ?");
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createVotazione($domanda, $idVotazione) 
    {
        $stmt = $this->conn->prepare("INSERT INTO votazioni (domanda,IDcollegio) VALUES (?, ?)");
        $stmt->bind_param("si", $domanda, $idVotazione);
        return $stmt->execute();
    }

    public function addVoto($idUtenteVotante, $idVotazione) 
    {
        $stmt = $this->conn->prepare("INSERT INTO voti (IDutenteVotante, IDvotazione) VALUES (?, ?)");
        $stmt->bind_param("ii", $idUtenteVotante, $idVotazione);
        return $stmt->execute();
    }


    public function getAllVotazioneFromCollegio($idCollegio)
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
    // creazioenVotazione
    // getVotazione
    // addVoto



    // cercaVotazione
}