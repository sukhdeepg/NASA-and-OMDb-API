<?php
    $db = mysqli_connect('localhost', 'root', 'test', 'college_proj');
    if(isset($_POST['store_json'])){
        $movie = $_POST['movie_name'];
        $encodedmovie = urlencode($movie); //To add + instead of spaces
        $json = file_get_contents('https://www.omdbapi.com/?apikey=4881a04c&t='.$encodedmovie);
        $obj = json_decode($json);
        $imdbID = $obj->imdbID;
        $title = $obj->Title;
        $runtime = $obj->Runtime;
        $released = $obj->Released;
        $genre = $obj->Genre;
        $director = $obj->Director;
        $rating = $obj->imdbRating;
        $imgurl = $obj->Poster;
        $query = "INSERT INTO omdb_json (imdbID, title, runtime, released, genre, director, imdbrating, poster) VALUES('$imdbID', '$title', '$runtime', '$released', '$genre', '$director', '$rating', '$imgurl')";
        $result = mysqli_query($db, $query);
        if($result){
             echo "<h1>Success</h1>";
         }else{
             echo "<h1>Error</h1>";
         }
    }
?>
