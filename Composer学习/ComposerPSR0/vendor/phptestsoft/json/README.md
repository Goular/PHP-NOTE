# README ME


# API

To use the library, see the example below:

     <?php
     require_once 'vendor/autoload.php';

     $data = [
         'a' => 'test',
         'b' => 'test'
     ];
     $jsondata = \phptestsoft\Json::encode($data);
     print_r($jsondata);

     $data2 = \phptestsoft\Json::decode($jsondata);
     print_r($data2);

    
# License

Licensed under the Apache License, Version 2.0;

   http://www.apache.org/licenses/LICENSE-2.0
