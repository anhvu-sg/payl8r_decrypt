<?php
$fp = fopen('./public_key.pem', 'r');
$pub_key_string=fread($fp,8192);
fclose($fp);

// Set the response header to be JSON
header('Content-Type: application/json');

// Get the POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['return_data'])) {
    $return_data = $data['return_data'];
} else {
    // Error response
    $return_data = '';
}

if ($encrypted_response = base64_decode($return_data)) {
  if (openssl_public_decrypt($encrypted_response, $response, $pub_key_string)) {
    if ($decoded_response = json_decode($response)) {
      echo $response;
    }
  }
}
?>