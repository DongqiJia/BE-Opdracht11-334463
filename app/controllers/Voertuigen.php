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
        $gebruikteVoertuigen = $this->voertuigModel->getBeschikbaarVoertuig($instructeurId);
        $instructeur = $this->voertuigModel->getBeschikbaarVoertuigById($instructeurId);
        
        if (sizeOf($gebruikteVoertuigen) == 0 ) {
            $rows = "<tr><td colspan='6'>Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur</td></tr>";
            header('Refresh:3; url=' . URLROOT . '/voertuigen/index');
        } else {
            $rows = '';
            foreach ($gebruikteVoertuigen as $value){
            $rows .= "<tr>
                        <td>$value->TypeVoertuig</td>
                        <td>$value->Type</td>
                        <td>$value->Kenteken</td>
                        <td>$value->Bouwjaar</td>
                        <td>$value->Brandstof</td>
                        <td>$value->Rijbewijscategorie</td>
                      </tr>";
            }
        }
        
        $data = [
           'title' => 'Door instructeur gebruikte voertuigen',
           'rows' => $rows,
           'Voornaam'=> $instructeur->Voornaam,
           'Achternaam' => $instructeur->Achternaam,
           'Tussenvoegsel' => $instructeur->Tussenvoegsel,
           'DatumInDienst' => $instructeur->DatumInDienst,
           'AantalSterren' => $instructeur->AantalSterren
        ];
        $this->view('voertuigen/beschikbaarvoertuig', $data);
    }
}