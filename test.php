<?php 

$data = "../img/course_img/download (1).jpg";

print_r(explode("../",$data)) ;


$str =explode("../",$data);

echo $str[1];

?>