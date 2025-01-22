<?php
    // die e debug
    function dd ($param = []){
        echo'<pre>';
        print_r($param);
        echo'</pre>';
        exit;
    }
?>