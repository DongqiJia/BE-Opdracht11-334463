<?php
class Voertuig
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getVoertuigen()
    {
        $this->db->query('SELECT * FROM instructeur order by AantalSterren desc');
        $result = $this->db->resultSet();
        return $result;
    }
    public function getBeschikbaarVoertuig($instructeurId)
    {
        $this->db->query('SELECT 
                                t.TypeVoertuig, 
                                v.Type, 
                                v.Kenteken,
                                v.Bouwjaar,
                                v.Brandstof,
                                t.Rijbewijscategorie,
                                i.Voornaam,
                                i.Tussenvoegsel ,
                                i.Achternaam,
                                i.DatumInDienst,
                                i.AantalSterren
                          from  voertuig v 
                          INNER JOIN typevoertuig t ON t.Id = v.TypeVoertuigId
                          INNER JOIN voertuiginstructeur vi ON vi.VoertuigId = v.Id
                          INNER JOIN instructeur i ON i.Id = vi.InstructeurId
                          Where i.Id = :Id order by t.Rijbewijscategorie asc');
        $this->db->bind(':Id', $instructeurId, PDO::PARAM_INT);
        $result = $this->db->resultSet();
        return $result;
    }
    public function getBeschikbaarVoertuigById($instructeurId)
    {
        $this->db->query('SELECT instructeur.Voornaam,
                                 instructeur.Tussenvoegsel,
                                 instructeur.Achternaam,
                                 instructeur.DatumInDienst,
                                 instructeur.AantalSterren
                          from instructeur
                          where Id = :Id;
                         ');
        $this->db->bind(':Id', $instructeurId, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;
    }
}
