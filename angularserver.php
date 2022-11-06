<?php

  header('Access-Control-Allow-Origin: http://localhost:4200');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
  header('Access-Control-Max-Age: 1000');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $data = [];
  $stringy = "";

  foreach ($request as $k => $v) {
    $data[0]['post_'.$k] = $v;
    //echo $data[0]['post_'.$k];
    $stringy = $v;
  }

  $current_date = date("Y-m-d");


  //Find how many times each word repeats
  $user_input = $stringy;
  $repeated_words = "";
  $map = array_count_values(str_word_count(strtolower($user_input), 1));
  foreach ($map as $word => $count) {
    $repeated_words = $repeated_words . $word . ": " . $count . "     |||     ";
  }


  echo json_encode(['content'=>$data, 'response_on'=>$current_date, 'How many times each word is repeated'=>$repeated_words]);


 ?>
