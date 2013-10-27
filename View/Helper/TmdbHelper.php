<?php
Configure::load('tmdb');
App::uses('HttpSocket', 'Network/Http');

class TmdbHelper extends AppHelper {

	public $helpers = array('Html');

	private function FetchImage($poster_path,$size){
		$HttpSocket = new HttpSocket();
		$response = $HttpSocket->get(
			Configure::read('Tmdb.url_base').'3/configuration',
			array(
				'api_key' => Configure::read('Tmdb.api_key'),
				'language' => Configure::read('Tmdb.lang')
			),
			array(
				'header' => array(
					'Accept' => Configure::read('Tmdb.format')
				)
			)
		);
		$return = json_decode($response, true);
		//Save Image
		$this->settings['img_url'] = $return['images']['secure_base_url'];
		$remoteimage = $return['images']['secure_base_url'].$size.$poster_path;
		$localimage = WWW_ROOT.'img/tmdb/'.$size.$poster_path;
		if ($content = file_get_contents($remoteimage)) {
		    if (!empty($content)) {
		        $fp = fopen($localimage, "w");
		        fwrite($fp, $content);
		        fclose($fp);
		    }
		}
	}

	private function IsExpired($file){
		$filedate = date('Y-m-d H:i:s',filectime($file));
		if (date_diff(date_create($filedate), date_create(date('Y-m-d H:i:s')))->format('%a') > 30){
			return true;
		} else {
			return false;
		}
	}

	public function GetMovieImage($poster_path,$size,$alt){
		$folderpath = WWW_ROOT.'img/tmdb/'.$size;
		$filepath = WWW_ROOT.'img/tmdb/'.$size.$poster_path;
	    //Check For Cached Image
		if(file_exists($filepath)){
			if(self::IsExpired($filepath)){
				unlink($filepath);
				self::FetchImage($filepath);
			}
			return $this->Html->image('tmdb/'.$size.$poster_path, array('alt' => $alt));
		} else {
			//Check for writable path
		    if (!is_dir($folderpath)){
		    	if(!is_writable($folderpath)){
		    		mkdir($folderpath, 0775, true);
		    	}
		    }
		    self::FetchImage($poster_path,$size);
			return $this->Html->image('tmdb/'.$size.$poster_path, array('alt' => $alt));
		}
	}

	public function GetMovieBackdrop($backdrop_path,$size){
		$folderpath = WWW_ROOT.'img/tmdb/'.$size;
		$filepath = WWW_ROOT.'img/tmdb/'.$size.$backdrop_path;
	    //Check For Cached Image
		if(file_exists($filepath)){
			if(self::IsExpired($filepath)){
				unlink($filepath);
				self::FetchImage($filepath);
			}
			return $this->webroot.'img/tmdb/'.$size.$backdrop_path;
		} else {
			//Check for writable path
		    if (!is_dir($folderpath)){
		    	if(!is_writable($folderpath)){
		    		mkdir($folderpath, 0775, true);
		    	}
		    }
		    self::FetchImage($backdrop_path,$size);
			return $this->webroot.'img/tmdb/'.$size.$backdrop_path;
		}
	}
}