<?php 
  $tip = $sf_request->getParameter('tip');
  if($tip && array_key_exists($place, $tip)) {
    echo $tip[$place];
  }
?>