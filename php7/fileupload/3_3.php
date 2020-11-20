<?php

if($_FILES['upload']['error']){
    var_dump($_FILES['upload']['error']);
}else{
    var_dump($_FILES);
}
