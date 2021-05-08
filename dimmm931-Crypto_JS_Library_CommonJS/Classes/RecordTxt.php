<?php
  class RecordTxt {

      /**
        * Saves users's vists to txt file.
        * @param array idArray list of values that need to be saved.
		* @param string $filename
        * @return 
        */
      public static function RecordAnyInput($idArray, $filename){
          $date = date("d.m.y.H:i");
          $uAgent = $_SERVER['HTTP_USER_AGENT'];
          $ip = $_SERVER['REMOTE_ADDR'];
          file_put_contents($filename, "\n \n-----------------------\n".$date. " - " .$ip. "\n".$uAgent,FILE_APPEND); //save  date,ip and  UsAgent;
          foreach ($idArray  as $itemSubj) {
              file_put_contents($filename, "\n".$itemSubj,FILE_APPEND);//save each array item  provided  ob calling  function;
          }
      }




} 


?>