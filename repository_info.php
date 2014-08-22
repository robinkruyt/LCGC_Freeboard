<?php
$repository = $_GET["repo"];
$fields;
date_default_timezone_set("Europe/Amsterdam");

function getInfo($repo){
  global $fields;
  $data = explode("\n", shell_exec("svn info -rHEAD http://svnchicken/svn/".$repo));

  foreach ($data as $key => $value) {
    $k = explode(": ", $value)[0];
    $k = strtolower($k);
    $k = str_replace(" ", "_", $k);
    $v = explode(": ", $value)[1];
    if($v == null){
      continue;
    }
    $fields[$k] = $v;
  }
}

function getCommits($repo){
  global $fields;
  $list = array();
  $commits = explode("------------------------------------------------------------------------", shell_exec("svn log -l 30 http://svnchicken/svn/".$repo));
  foreach ($commits as $key => $commit) {
    $lines = _cleanLines(explode("\n", $commit));

    $properties = _getMeta($lines[0]);
    if(!$properties){
      continue;
    }
    $message = implode("\n", array_slice($lines, 1));
    array_push($list, array("properties"=>$properties, "message" => $message));
  }
  $fields["details"] = $list;
}

function _cleanLines($lines){
    // Removes empty lines
    $newLines = array();
    foreach ($lines as $key => $line) {
      if(strlen($line) > 1){
        array_push($newLines, $line);
      }
    }
    return $newLines;
}

function _getMeta($rawMeta){
  $meta = explode(" | ", $rawMeta);
    if($meta[1] == null){
      return false;
    }
    return array("revision" => $meta[0],"author" => $meta[1],"date" => $meta[2]);
}

function getVelocity($repo){
  global $fields;
  $commits = explode("------------------------------------------------------------------------", shell_exec("svn log -l 100 http://svnchicken/svn/".$repo));
  array_pop($commits);
  array_shift($commits);

  $startTime;
  $endTime;

  // First commit
  $lines = _cleanLines(explode("\n", $commits[0]));
  $properties = _getMeta($lines[0]);
  $startTime = DateTime::createFromFormat("Y-m-d H:i:s O", substr($properties["date"], 0, 25));

  // Last commit
  $lines = _cleanLines(explode("\n", end($commits)));
  $properties = _getMeta($lines[0]);
  $endTime = DateTime::createFromFormat("Y-m-d H:i:s O", substr($properties["date"], 0, 25));

  $amount = count($commits);
  $diff = $endTime->diff($startTime);
  $hours = $diff->h;


  $fields["velocities"] = array("global" => $amount / $hours, "hours"=> $hours, "amount" => $amount);
  /*foreach ($commits as $key => $commit) {
    
  }*/
}

getInfo($repository);
getCommits($repository);
getVelocity($repository);

echo json_encode($fields);

?>