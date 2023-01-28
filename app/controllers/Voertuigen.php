<?php
class Voertuigen extends Controller
{
    private $voertuigModel;
    public function __construct()
    {
        $this->voertuigModel = $this->model('Voertuig');
    }
    public function index()
    {
        $result = $this->voertuigModel->getVoertuigen();

        $rows = '';
        foreach($result as $instructeur) {
           $rows .= "<tr>
           <td>$instructeur->Voornaam</td>
           <td>$instructeur->Tussenvoegsel</td>
           <td>$instructeur->Achternaam</td>
           <td>$instructeur->Mobiel</td>
           <td>$instructeur->DatumInDienst</td>
           <td>$instructeur->AantalSterren</td>
           <td><a href='" . URLROOT ."/voertuigen/beschikbaarvoertuig/{$instructeur->Id}'><i class= '" . URLROOT . "bi bi-car-front-fill'></i></td>
           </tr>";
        }
        $data = [
            'title' => "Instructeurs in dienst",
            'instructeur' => "5",
            'rows' => $rows
        ];
        $this->view('voertuigen/index', $data);
    }
    public function beschikbaarvoertuig($instructeurId)
    {
        $result = $this->voertuigModel->getBeschikbaarVoertuig($instructeurId);
        if ($result)
        {
           $Voornaam = $result[0]->Voornaam;
           $Tussenvoegsel = $result[0]->Tussenvoegsel;
           $Achternaam = $result[0]->Achternaam;
           $DatumInDienst = $result[0]->DatumInDienst;
           $AantalSterren = $result[0]->AantalSterren;
        }
        else 
        {
            $Voornaam = '';
            $Tussenvoegsel = '';
            $Achternaam = '';
            $DatumInDienst = '';
            $AantalSterren = '';
        }
        $rows = "";
        foreach ($result as $beschikbaarvoertuig) {
            $rows .= "<tr>
                      <td>$beschikbaarvoertuig->TypeVoertuig</td>
                      <td>$beschikbaarvoertuig->Type</td>
                      <td>$beschikbaarvoertuig->Kenteken</td>
                      <td>$beschikbaarvoertuig->Bouwjaar</td>
                      <td>$beschikbaarvoertuig->Brandstof</td>
                      <td>$beschikbaarvoertuig->Rijbewijscategorie</td>
                     </tr>";
        }
        $data = [
           'title' => 'Door instructeur gebruikte voertuigen',
           'rows' => $rows,
           'Voornaam'=> $Voornaam,
           'Achternaam' => $Achternaam,
           'Tussenvoegsel' => $Tussenvoegsel,
           'DatumInDienst' => $DatumInDienst,
           'AantalSterren' => $AantalSterren
        ];
        $this->view('voertuigen/beschikbaarvoertuig', $data);
    }
}