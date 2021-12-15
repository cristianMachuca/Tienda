<?php
foreach (glob("./controllers/*.php") as $filename)
{
    include $filename;
}

function main() {
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $arr = explode('/', $uri);
  $requestMethod = $_SERVER["REQUEST_METHOD"]; //Get, Post, Put, Delete
  $param=null;
  if(count($arr)>2){
    $param = $arr[2];
  }

  if($requestMethod == 'OPTIONS') {
    response(["Status" => "Ok"], 200);
    exit();
  }

  switch ($arr[1]) {
    case 'local':
      $local = new LocalController($requestMethod, $param);
      $local->init();
      break;
      default:
      response(['error' => 'Method not found'], 404);
      break;
    
  }
}