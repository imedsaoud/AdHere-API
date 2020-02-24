<?php

function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
  $earthRadius = 6378137;   
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}

$pdo  = new PDO(
  'mysql:host=localhost:3306;dbname=adhere;',
  'root',
  'root',
  [
    PDO::ATTR_ERRMODE             => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES utf8',
  ]
);


// --------------------------STATION-------------------------------------------
$jsonStation = file_get_contents("../data/station/station.json");
$json_data_station = json_decode($jsonStation, true);
foreach ($json_data_station as $item) {

  $stmt = $pdo->prepare("INSERT INTO station (
        name, lt, lng, affluence
    ) VALUES (
        :name, :lt, :lng, :affluence
    )");
  $stmt->bindParam(':name', $item["name"]);
  $stmt->bindParam(':lt', $item["latitude"]);
  $stmt->bindParam(':lng', $item["longitude"]);
  $stmt->bindParam(':affluence', $item["nb_valid"]);


  $stmt->execute();
}


// --------------------------FEDERATION-------------------------------------------

$jsonFederation = file_get_contents("../data/federation/federation.json");
$json_data_federation = json_decode($jsonFederation, true);
foreach ($json_data_federation as $item) {

  $stmt = $pdo->prepare("INSERT INTO federation (
        name, count
    ) VALUES (
        :name, :count 
    )");
  $stmt->bindParam(':name', $item["federation"]);
  $stmt->bindParam(':count', $item["count"]);
  $stmt->execute();
}



//-------------------------GET_Federation-------------------------------------------------------


$stmt = $pdo->prepare("select * from federation;");
$stmt->execute();
$federationTab = $stmt->fetchAll();



//-------------------------EVENTS-------------------------------------------------------
$jsonEvents = file_get_contents("../data/event/evenement_2.json");
$json_data_events = json_decode($jsonEvents, true);
foreach ($json_data_events as $item) {
  foreach ($federationTab as $federation) {
    if($federation['name'] === $item["fédération"]){
      $stmt = $pdo->prepare("INSERT INTO events (
        date_start, date_end,geo_name, geo_lat,geo_lng,spectator,id_federation
      ) VALUES (
        :date_start, :date_end, :geo_name, :geo_lat, :geo_lng, :spectator,:id_federation
      )");
      $stmt->bindParam(':date_start', $item["date_de_debut"]);
      $stmt->bindParam(':date_end', $item["date_de_fin"]);
      $stmt->bindParam(':geo_name', $item["nom_du_lieux"]);
      $stmt->bindParam(':geo_lat', $item["latitude"]);
      $stmt->bindParam(':geo_lng', $item['longitude']);
      $stmt->bindParam(':spectator', $item['capacité']);
      $stmt->bindParam(':id_federation', $federation['id']);

      $stmt->execute();
    }
  }
}



// --------------------------FEDERATION_CSP-------------------------------------------
$jsonFederationCsp = file_get_contents("../data/federation/federation_csp.json");
$json_data_federation_csp = json_decode($jsonFederationCsp, true);

foreach ($json_data_federation_csp as $item) {

  foreach($federationTab as $federation) {

    if ($federation["name"] === $item["federation"]) {
      $stmt = $pdo->prepare("INSERT INTO federation_csp (
        id,ouvrier, cadre, agriculteur, inactif,employe,retraite,profinter
      ) VALUES (
        :id,:ouvrier, :cadre, :agriculteur, :inactif,:employe,:retraite,:profinter 
      )");
      $stmt->bindParam(':id', $federation["id"]);
      $stmt->bindParam(':ouvrier', $item["ouvrier"]);
      $stmt->bindParam(':cadre', $item["cadres_et_profession_intelectuelles_supérieur"]);
      $stmt->bindParam(':agriculteur', $item["agriculteur"]);
      $stmt->bindParam(':inactif', $item["non_actif"]);
      $stmt->bindParam(':employe', $item["employes"]);
      $stmt->bindParam(':retraite', $item["retraite"]);
      $stmt->bindParam(':profinter', $item["profession_intermediaire"]);
      $stmt->execute();
    }
  }
}

// --------------------------FEDERATION_SEXE_AGE_RANGE-------------------------------------------
$jsonFederationAge = file_get_contents("../data/federation/federation_sexe_age_range.json");
$json_data_federation_age = json_decode($jsonFederationAge, true);

foreach ($json_data_federation_age as $item) {

  foreach($federationTab as $federation) {
    if ($federation["name"] === $item["federation"]) {
      $stmt = $pdo->prepare("INSERT INTO federation_sexe_age_range (
        sexe, age_range, count,id_Federation
      ) VALUES (
        :sexe, :age_range, :count, :id_Federation
      )");
      $stmt->bindParam(':id_Federation', $federation["id"]);
      $stmt->bindParam(':sexe', $item["sexe"]);
      $stmt->bindParam(':age_range', $item["age_range"]);
      $stmt->bindParam(':count', $item["count"]);
      $stmt->execute();
    }
  }
}


// ----------------------------------STATION_DISTANCE_EVENTS----------------------------
$stmt = $pdo->prepare("select * from events;");
$stmt->execute();
$events = $stmt->fetchAll();

$stmt = $pdo->prepare("select * from station;");
$stmt->execute();
$stations = $stmt->fetchAll();

foreach ($events as $kKey => $event) {
  foreach ($stations as $vKey => $station) {

    echo $station[i]."Powerrr";
    $distance = getDistance($event['geo_lat'],$event['geo_lng'],$station['lt'],$station['lng']);
    $stmt = $pdo->prepare("INSERT INTO station_distance_event (
      distance_m,id_Station,id_Events 
  ) VALUES (
    :distance_m,:id_Station,:id_Events
  )");

  $stmt->bindParam(':distance_m', $distance);
  $stmt->bindParam(':id_Events',$event['id']);
  $stmt->bindParam(':id_Station', $station['id'] );

  $stmt->execute();
  }
}

