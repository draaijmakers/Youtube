/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=7Qhpy4RvA5M//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Gegevens beveiligen versleutelen / encryptie - PHP #24 */

<?php

$key = 'hoi123';
echo md5($key);
// 381e23f8d00be94c13559f76d488f64f

echo base64_encode($key);
// aG9pMTIz

// MD5 en BASE
echo md5(base64_encode($key));
// 15fdb35571e84ab6b4140418b9ae361a


// BASE 64 plus toevoeging
echo base64_encode($key).rand(1,9);
// aG9pMTIz1

echo rand(1,9).base64_encode($key);
// 5aG9pMTIz


// BASE 64 plus toevoeging en weer BASE
echo base64_encode(base64_encode($key).rand(1,9));
// YUc5cE1USXo5
echo base64_encode(rand(1,9).base64_encode($key));
// M2FHOXBNVEl6


// DE CODE IS: BN01UZzROa1JoZG1WNTY=
// Weet jij wat hier staat? Neem dan snel contact met mij op!

?>