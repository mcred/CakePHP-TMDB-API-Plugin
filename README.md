CakePHP-TMDB-API-Plugin
=======================

A CakePhp Plugin that interacts with the API from themoviedb.org. The component will get/post data to/from the API and return an array to the controller. The helper will fetch the image from the API and save a local version for future use. Images cached from the API expire after 30 days and will be fetched again. 

#Requirements#
*PHP 4,5<br />
*CakePhp 2+<br />
*TMDb API key

#Installation#
```
$ cd /your_app_path/Plugin
$ git submodule add git@github.com:mcred/CakePHP-TMDB-API-Plugin.git Tmdb
```

#Configuration#
1. Create an account at http://www.themoviedb.org/
2. Obtain your API key
3. Create a copy of tmdb.php to /app/Config/tmdb.php
4. Insert your API Key and update any settings
5. Edit your /app/Controller/AppController.php

```
class AppController extends Controller {
	public $components = array('Tmdb.Tmdb');
	public $helpers = array('Tmdb.Tmdb');
}
```

#Examples#
Get Movie Information for your Controller
```
$movies = $this->Tmdb->getMovie(550,array('append_to_response'=>'trailers'));
debug($movies);
```

Display Movie Poster from your View
```
echo $this->Tmdb->GetMovieImage('/2lECpi35Hnbpa4y46JX0aY3AWTy.jpg','w342','Fight Club');
```

#Change History#
CakePHP TMDB v.1 - 2013-10-25<br />
*Initial Committ