<?php

class http {
   var $proxy_host = "";
   var $proxy_port = 0;



   function http_fopen($host, $path, $port = 80) {

      # has the user set $proxy_host?
      if(empty($this->proxy_host)) {
         # we access the server directly
         $conn_host = $host;
         $conn_port = $port;
      } else {
         # we use the proxy
         $conn_host = $this->proxy_host;
         $conn_port = $this->proxy_port;
      }

        # build the absolute URL
      $abs_url = "http://$host:$port$path";

      # now we build our query
      $query = "GET $abs_url HTTP/1.0\r\n".
               "Host: $host:$port\r\n".
               "User-agent: PHP/class http 0.1\r\n".
               "\r\n";

  	  # open a connection to the server
      //    string Ê target , int Ê port , int Ê errno , string Ê errstr , float Êtimeout
      if($port == 443) {
        $fp = fsockopen("ssl://".$conn_host, $conn_port);
      } else {
        $fp = fsockopen($conn_host, $conn_port);
      }

      # if the connection failed, return false
      if(!$fp)
         return false;

      # send our query
      fputs($fp, $query);

      # discard the HTTP header
      while(trim(fgets($fp, 1024)) != "");

      # return the active file pointer
      return $fp;
   }
}
?>
