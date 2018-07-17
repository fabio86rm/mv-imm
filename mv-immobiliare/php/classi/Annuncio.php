<?php
class Annuncio{
    
    private $idAnnuncio;
    private $idCategoria;
    private $citta;
    private $indirizzo;
    private $prezzo;
    private $descrizioneBreve;
    private $descrizioneCompleta;
    
    /*
     * constructor
     */
    function __construct($idAnnuncio) {
        $this->idAnnuncio = $idAnnuncio;
    }
    
    
    /*
     * getter methods
     */
    public function getIdAnnuncio()
    {
        return $this->idAnnuncio;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function getCitta()
    {
        return $this->citta;
    }

    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function getDescrizioneBreve()
    {
        return $this->descrizioneBreve;
    }

    public function getDescrizioneCompleta()
    {
        return $this->descrizioneCompleta;
    }

    /*
     *  setter methods
     */
    public function setIdAnnuncio($idAnnuncio)
    {
        $this->idAnnuncio = $idAnnuncio;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function setCitta($citta)
    {
        $this->citta = $citta;
    }

    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;
    }

    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    public function setDescrizioneBreve($descrizioneBreve)
    {
        $this->descrizioneBreve = $descrizioneBreve;
    }

    public function setDescrizioneCompleta($descrizioneCompleta)
    {
        $this->descrizioneCompleta = $descrizioneCompleta;
    }
    
}
?>