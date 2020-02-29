<?php
// --------------------------STATION-------------------------------------------
$station_geo = file_get_contents("../data/station/station_geo.json");
$json_station_geo = json_decode($station_geo, true);

$station_valids = file_get_contents("../data/station/station_nb_valid.json");
$json_station_valids = json_decode($station_valids, true);

foreach ($json_station_valids as $station_valid) {
    foreach ($json_station_geo as $station_geo) {

        if( $station_valid['LIBELLE_ARRET'] === $station_geo['Nom']) {
            $json_station_final[] = array(
                'name'=>$station_geo['Nom'],
                'latitude'=>$station_geo['latitude'],
                'longitude'=>$station_geo['longitude'],
                'nb_valid'=>$station_valid['NB_VALID']
            );
        }
    }

}


$newJson = json_encode($json_station_final);
file_put_contents('station_v1.json', $newJson);
