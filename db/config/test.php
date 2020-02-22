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

// --------------------------FEDERATION_CSP-------------------------------------------
$jsonFederationCsp = file_get_contents("../data/federation/federation_csp.json");
$json_data_federation_csp = json_decode($jsonFederationCsp, true);

foreach ($json_data_federation_csp as $item) {

  foreach($federationTab as $federation) {
    if ($json_data_federation_csp["fdt_name"] === $item["federation"]) {
      $stmt = $pdo->prepare("INSERT INTO csp (
        id,ouvrier, cadre, agriculteur, inactif,employe,retraite,profinter
      ) VALUES (
        :id,:ouvrier, :cadre, :agriculteur, :inactif,:employe,:retraite,:profinter 
      )");
      $stmt->bindParam(':id', $federation["fdt_id"]);
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
    if ($json_data_federation_csp["fdt_name"] === $item["federation"]) {
      $stmt = $pdo->prepare("INSERT INTO csp (
        id,sexe, age_range, count
      ) VALUES (
        :id,:sexe, :age_range, :count, 
      )");
      $stmt->bindParam(':id', $federation["fdt_id"]);
      $stmt->bindParam(':sexe', $item["sexe"]);
      $stmt->bindParam(':age_range', $item["age_range"]);
      $stmt->bindParam(':count', $item["count"]);
      $stmt->execute();
    }
  }


}