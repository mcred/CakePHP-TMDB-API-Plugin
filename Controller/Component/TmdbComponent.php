<?php
//TMDB API CakePHP Plugin
//Author: Derek Smart
//GitHub: https://github.com/mcred
//Version: 0.1
//Date: 2013-10-23

//Please Refer to http://docs.themoviedb.apiary.io/ for full API documentation.
//Obtain your API key by creating an account at http://www.themoviedb.org/
Configure::load('tmdb');
App::uses('HttpSocket', 'Network/Http');

class TmdbComponent extends Component {

	private function makeCall($request,$data=null) {
		$HttpSocket = new HttpSocket();
		$response = $HttpSocket->get(
			Configure::read('Tmdb.url_base').'3/'.$request,
			array(
				'api_key' => Configure::read('Tmdb.api_key'),
				'language' => Configure::read('Tmdb.lang'),
				$data,
			),
			array(
				'header' => array(
					'Accept' => Configure::read('Tmdb.format')
				)
			)
		);
		return json_decode($response, true);
	}

	//Configiration
	public function getConfiguration(){
		return self::makeCall('configuration');
	}

	//Authentication
	public function getAuthenticationTokenNew(){
		return self::makeCall('authentication/token/new');
	}
	public function getAuthenticationTokenSessionNew(){
		return self::makeCall('authentication/session/token/new');
	}
	public function getAuthenticationTokenGuestNew(){
		return self::makeCall('authentication/guest/token/new');
	}

	//Account
	public function getAccount($id){
		return self::makeCall('account/'.$id);
	}
	public function getAccountLists($id,$options=null){
		return self::makeCall('account/'.$id.'/lists',$options);
	}
	public function getAccountFavoriteMovies($id,$options=null){
		return self::makeCall('account/'.$id.'/favorite_movies',$options);
	}
	public function postAccountFavorite($id,$options=null){
		return self::makeCall('account/'.$id.'/favorite',$options);
	}
	public function getAccountRatedMovies($id,$options=null){
		return self::makeCall('account/'.$id.'/rated_movies',$options);
	}
	public function getAccountMovieWatchlist($id,$options=null){
		return self::makeCall('account/'.$id.'/movie_watchlist',$options);
	}
	public function postAccountMovieWatchlist($id,$options=null){
		return self::makeCall('account/'.$id.'/movie_watchlist',$options);
	}

	//Movie
	public function getMovie($id,$options=null){
		return self::makeCall('movie/'.$id,$options);
	}
	public function getMovieAlternativeTitles($id,$options=null){
		return self::makeCall('movie/'.$id.'/alternative_titles',$options);
	}
	public function getMovieCasts($id,$options=null){
		return self::makeCall('movie/'.$id.'/casts',$options);
	}
	public function getMovieImages($id,$options=null){
		return self::makeCall('movie/'.$id.'/images',$options);
	}
	public function getMovieKeywords($id,$options=null){
		return self::makeCall('movie/'.$id.'/keywords',$options);
	}
	public function getMovieReleases($id,$options=null){
		return self::makeCall('movie/'.$id.'/releases',$options);
	}
	public function getMovieTrailers($id,$options=null){
		return self::makeCall('movie/'.$id.'/trailers',$options);
	}
	public function getMovieTranslations($id,$options=null){
		return self::makeCall('movie/'.$id.'/translations',$options);
	}
	public function getMovieSimilarMovies($id,$options=null){
		return self::makeCall('movie/'.$id.'/similar_movies',$options);
	}
	public function getMovieReviews($id,$options=null){
		return self::makeCall('movie/'.$id.'/reviews',$options);
	}
	public function getMovieLists($id,$options=null){
		return self::makeCall('movie/'.$id.'/lists',$options);
	}
	public function getMovieChanges($id,$options=null){
		return self::makeCall('movie/'.$id.'/changes',$options);
	}
	public function getMovieLatest(){
		return self::makeCall('movie/latest');
	}
	public function getMovieUpcoming(){
		return self::makeCall('movie/upcoming');
	}
	public function getMovieNowPlaying(){
		return self::makeCall('movie/now_playing');
	}
	public function getMovieTopRated(){
		return self::makeCall('movie/top_rated');
	}
	public function getMovieAccountStates($id){
		return self::makeCall('movie/'.$id.'/account_states');
	}
	public function postMovieRating($id,$options=null){
		return self::makeCall('movie/'.$id.'/rating',$options);
	}

	//Collections
	public function getCollection($id,$options=null){
		return self::makeCall('collection/'.$id,$options);
	}
	public function getCollectionImages($id,$options=null){
		return self::makeCall('collection/'.$id.'/images',$options);
	}

	//TV
	public function getTV($id,$options=null){
		return self::makeCall('tv/'.$id.$options);
	}
	public function getTVCredits($id,$options=null){
		return self::makeCall('tv/'.$id.'/credits',$options);
	}
	public function getTVExternalIds($id,$options=null){
		return self::makeCall('tv/'.$id.'/external_ids',$options);
	}
	public function getTVImages($id,$options=null){
		return self::makeCall('tv/'.$id.'/images',$options);
	}

	//TV Seasons
	public function getTVSeason($id,$season,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season,$options);
	}
	public function getTVSeasonExternalIds($id,$season,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/external_ids',$options);
	}
	public function getTVSeasonImages($id,$season,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/images',$options);
	}

	//TV Episodes
	public function getTVEpisode($id,$season,$episode,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/episode/'.$episode,$options);
	}
	public function getTVEpisodeCredits($id,$season,$episode,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/episode/'.$episode.'/credits',$options);
	}
	public function getTVEpisodeExternalIds($id,$season,$episode,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/episode/'.$episode.'/external_ids',$options);
	}
	public function getTVEpisodeImages($id,$season,$episode,$options=null){
		return self::makeCall('tv/'.$id.'/seasons/'.$season.'/episode/'.$episode.'/images',$options);
	}

	//People
	public function getPerson($id,$options=null){
		return self::makeCall('person/'.$id,$options);
	}
	public function getPersonCredits($id,$options=null){
		return self::makeCall('person/'.$id.'/credits',$options);
	}
	public function getPersonImages($id){
		return self::makeCall('person/'.$id.'/images');
	}
	public function getPersonChanges($id,$options=null){
		return self::makeCall('person/'.$id.'/changes',$options);
	}
	public function getPersonPopular(){
		return self::makeCall('person/popular');
	}
	public function getPersonLatest(){
		return self::makeCall('person/latest');
	}

	//Lists
	public function getList($id){
		return self::makeCall('list/'.$id);
	}
	public function getListItemStatus($id){
		return self::makeCall('list/'.$id.'/item_status');
	}
	public function postListAdd($options=null){
		return self::makeCall('list',$options);
	}
	public function postListAddItem($id,$options=null){
		return self::makeCall('list/'.$id.'/add_item',$options);
	}
	public function postListRemoveItem($id,$options=null){
		return self::makeCall('list/'.$id.'/remove_item',$options);
	}
	public function postListRemove($id){
		return self::makeCall('list/'.$id);
	}

	//Companies
	public function getCompany($id,$options=null){
		return self::makeCall('company/'.$id,$options);
	}
	public function getCompanyMovies($id,$options=null){
		return self::makeCall('company/'.$id.'/movies',$options);
	}

	//Genres
	public function getGenre($id,$options=null){
		return self::makeCall('genre/'.$id,$options);
	}
	public function getGenreMovies($id,$options=null){
		return self::makeCall('genre/'.$id.'/movies',$options);
	}

	//Keywords
	public function getKeyword($id,$options=null){
		return self::makeCall('keyword/'.$id,$options);
	}
	public function getKeywordMovies($id,$options=null){
		return self::makeCall('keyword/'.$id.'/movies',$options);
	}

	//Discover
	public function getDiscover($options=null){
		return self::makeCall('discover/movie',$options);
	}

	//Search
	public function searchMovie($options=null){
		return self::makeCall('search/movie',$options);
	}
	public function searchCollection($options=null){
		return self::makeCall('search/collection',$options);
	}
	public function searchTV($options=null){
		return self::makeCall('search/tv',$options);
	}
	public function searchPerson($options=null){
		return self::makeCall('search/person',$options);
	}
	public function searchList($options=null){
		return self::makeCall('search/list',$options);
	}
	public function searchCompany($options=null){
		return self::makeCall('search/company',$options);
	}
	public function searchKeyword($options=null){
		return self::makeCall('search/keyword',$options);
	}

	//Reviews
	public function getReview($id){
		return self::makeCall('review/'.$id);		
	}

	//Changes
	public function getMovieChangesList($id,$options=null){
		return self::makeCall('movie/changes'.$id,$option);
	}
	public function getPersonChangesList($id,$options=null){
		return self::makeCall('person/changes'.$id,$option);
	}

	//Jobs
	public function getJobList(){
		return self::makeCall('job/list');
	}
}