<?php
	require_once('utils.php');
	require_once('Db.php');
	
	// include composer autoload
	require 'vendor/autoload.php';
	// import the Intervention Image Manager Class
	use Intervention\Image\ImageManagerStatic as Manager;
	// configure with favored image driver (gd by default)
	Manager::configure(array('driver' => 'GD'));

	class Image
	{
		public $obj;
		public $extension;
		public $source;

		function __construct($id)
		{
			$this->obj = Db::instance()->getImageFromId($id);
			if ($this->obj == null) return false;

			$this->obj->userName = Db::instance()->getUserFromId($this->obj->userId)->name;

			$tab = explode('.', $this->obj->url);
			$this->extension = $tab[1];
			$this->source = Manager::make($this->obj->url);
		}

		function save()
		{
			$this->source->save($this->obj->url);
			//$this->update();
		}

		private function update()
		{
			DB::instance()->updateImg($this->obj, $this->source, $this->extension);
		}

		// FILTERS
		function resizeTo420px()
		{
			$this->source->resize(420, 420);
			$this->save();
		}

		function contrast($val)
		{
			$this->source->contrast($val);
			$this->save();
		}

		function brightness($val)
		{
			$this->source->brightness($val);
			$this->save();
		}

		function opacity($val)
		{
			$this->source->opacity($val);
			$this->save();
		}

		function grayScale()
		{
			$this->source->greyscale();
			$this->save();
		}

		function blur($val = null)
		{
			if ($val == null) 	$this->source->blur();
			else 				$this->source->blur($val);
			$this->save();
		}

		function edgeDetect()
		{
			imagefilter($this->source->getCore(), IMG_FILTER_EDGEDETECT);
			$this->save();
		}

		function sepia()
		{
			$this->grayScale();
        	$this->brightness(-10);
        	$this->contrast(10);
        	$this->source->colorize(38, 27, 12);
        	$this->brightness(-10);
        	$this->contrast(10);
		}

		// STATIC
		public static function saveImageUploaded($userId, $image, $extension)
		{
			$path = 'images/'.$userId.'/';
			if (!file_exists($path)) {
    			mkdir($path, 0777, true);
			}
			$name = md5(uniqid(rand(), true));
			$path .= $name.".".$extension;

			$moved = move_uploaded_file($image['tmp_name'], $path);
			return $moved ? $path : null;
		}

		public static function getHtmlForImage($img, $connected, $user)
		{
			$myImage = $connected == true && $user->id == $img->userId;

			$str = '<div class="imgView" id="id'.$img->id.'">';
			if ($myImage) $str .= '<a class="img" href="edit.php?id='.$img->id.'">';
			$str .= '<img ';
			if (!$myImage) $str .= 'class="img" ';
			$str .= 'src="'.$img->url.'"></img>';
			if ($myImage) $str .= '</a>';
			$str .= '<div class="imgData">';
			$str .= '<p class="title">Uploaded by <u><a href="index.php?id='.$img->userId.'">'.$img->userName.'</a></u></p>';
			$str .= '<div class="description"><p class="descriptionText">'.$img->desc.'</p></div>';
			$str .= '<div class="tags"><p class="descriptionText">';
	
			$tags = explode(",", str_replace(" ", ",", $img->tags));
			foreach ($tags as $value) {
				$str .= ''.$value.' ';
			}
			$str .= '</p></div>';
			$str .= '</div>';
			if ($connected && $user->id == $img->userId)
			{
				$str .= '<a href="index.php?id='.$user->id.'&delete='.$img->id.'"><button class="delete" id="'.$img->id.	'">X</button></a>';
			}
			$str .= '</div>';
	
			return $str;
		}
	}
?>