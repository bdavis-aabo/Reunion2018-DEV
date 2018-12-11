<?php

//Instagram Feed
function instagram_connect($_apiUrl){
  $_connection_c = curl_init();
  curl_setopt($_connection_c, CURLOPT_URL, $_apiUrl);
  curl_setopt($_connection_c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($_connection_c, CURLOPT_TIMEOUT, 20);
  $_jsonReturn = curl_exec($_connection_c);
  curl_close($_connection_c);
  return json_decode($_jsonReturn);
}

?>
