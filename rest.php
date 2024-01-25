<?php

$api_token = 'ef18432fb61d7e5ed2dfed66422dde735f486eb3';
$company_domain = 'futurama';

// Create a person
$person = array(
  'name' => $_POST['name'],
  'last_name' => $_POST['surname'],
  'phone' => array(
    array(
      'value' => $_POST['phone'],
      'primary' => true,
      'label' => 'mobile'
    )
  ),
  'email' => array(
    array(
      'value' => $_POST['email'],
      'primary' => true,
      'label' => 'main'
    )
  ),
);

$createPerson = 'https://' . $company_domain . '.pipedrive.com/v1/persons?api_token=' . $api_token;

function build_post_fields($data, $existingKeys = '', &$returnArray = [])
{
  if (($data instanceof CURLFile) or !(is_array($data) or is_object($data))) {
    $returnArray[$existingKeys] = $data;
    return $returnArray;
  } else {
    foreach ($data as $key => $item) {
      build_post_fields($item, $existingKeys ? $existingKeys . "[$key]" : $key, $returnArray);
    }
    return $returnArray;
  }
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $createPerson);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, build_post_fields($person));

echo 'Sending request...' . PHP_EOL;

$output = curl_exec($ch);
curl_close($ch);

$result = json_decode($output, true);

// Check a Person creation result
if (!empty($result['data']['id'])) {
  echo 'Person was added successfully! ' . $result['data']['id'] . PHP_EOL;
}


// Create a deal
$deal = array(
  'title' => 'Test Deal',
  'user_id' => $result['data']['owner_id']['id'],
  "person_id" => $result['data']['id'],

  // job type - text
  '4464e29bb39e82b3232ddd64d750caddc9a9295d' => $_POST['task-type'],

  // job source - single opt
  'ccadc485c8f915cb82e02e97482e375ca4c40145' => $_POST['task-source'],

  // job descr
  '5f7dc64b0a85141720503cbf3304ccbce6bd1a28' => $_POST['task-adds'],

  // job date - date
  '3228fcc60cd9685b60559b910e97196224177610' => $_POST['date'],

  // job start time - time range
  '7aca404b539b866419a41dd0db248c9423dc9937' => $_POST['start-time'] . ":00",

  // job end time - time range
  '00271466c0096d2febd870c0a9e0d32659d8050c' => $_POST['end-time'] . ":00",

  // technician - user
  '7082fe6552830c00556f9e0a0f4145189b8e7797' => $_POST['technician'],

  // address - text
  '0384de371d92b3c90b9d49248b0458d9b8775105' => $_POST['address'],

  // city - text
  'e82773d30a54118cc62c81b70ddfd324d0ed7013' => $_POST['city'],

  // state - text
  '0acaafd73f9a4952373e6e90f915bbab61b78d62' => $_POST['street'],

  // zip-code - text
  '2a68500e856d0e109ca1d861c00673bdafabf8f7' => $_POST['index'],

  // region - single option
  'cba2a79925612d521b571cd7cecf938210bfa2b8' => $_POST['region']

);

$createDeal = 'https://' . $company_domain . '.pipedrive.com/v1/deals?api_token=' . $api_token;

$dealRequest = curl_init();
curl_setopt($dealRequest, CURLOPT_URL, $createDeal);

curl_setopt($dealRequest, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dealRequest, CURLOPT_POST, true);
curl_setopt($dealRequest, CURLOPT_POSTFIELDS, $deal);

echo 'Sending request...' . PHP_EOL;

$outputOfDeal = curl_exec($dealRequest);
curl_close($dealRequest);

$resultOfDeal = json_decode($outputOfDeal, true);

// Check a Deal creation result
if (!empty($resultOfDeal['data'])) {                                          
  echo 'Deal was added ' . $resultOfDeal['data']['id'] . PHP_EOL;
}
