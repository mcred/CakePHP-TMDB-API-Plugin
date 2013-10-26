<?php
/**
* Save the file to app/Config/tmdb.php
* Please Refer to http://docs.themoviedb.apiary.io/ for full API documentation.
* Obtain your API key by creating an account at http://www.themoviedb.org/
*/
$config = array(
  'Tmdb' => array(
    'url_base' => 'https://api.themoviedb.org/',
    'api_key' => 'PUT_API_KEY_HERE',
    'format' => 'application/json',
    'lang' => 'en'
  )
);
?>