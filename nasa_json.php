<?php
    $db = mysqli_connect('localhost', 'root', 'test', 'college_proj');
    function clear($string){
        return preg_replace("/[^ \w]+/", '', $string);
    }

    if(isset($_POST['store_json'])){
        $json = file_get_contents('https://api.nasa.gov/planetary/apod?api_key=kdBzUn723FcRUUw3bIfXijABy7OMokvHiorWmsGh');
        $obj = json_decode($json);
        $date = $obj->date;
        $explain = $obj->explanation;
        $title = $obj->title;
        $clean_title = clear($title);
        $url = $obj->url;
        $query = "INSERT INTO nasa_json (date, title, url) VALUES('$date', '$clean_title', '$url')";
        $result = mysqli_query($db, $query);
        if($result){
            echo "<h1>Success</h1>";
        }else{
            echo "<h1>Error</h1>";
        }
    }
