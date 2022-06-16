<?php


namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AppServices {
    protected $httpClient;

    /**
     * StatutService constructor.
     * @param $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function searchByCodePostal($codePostal){
        $response = $this->httpClient->request(
            'GET',
            'https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre&q=code_postal_uai%3D'.$codePostal.'&rows=50&facet=numero_uai&facet=appellation_officielle&facet=secteur_public_prive_libe&facet=code_postal_uai'
        );
        $data = json_decode($response->getContent(),true)['records'];
        dump($response->getStatusCode());
        $schoolList =[];
        foreach($data as $et){
            array_push($schoolList,$et['fields']);
        }

        return $schoolList;
    }
}