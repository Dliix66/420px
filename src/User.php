<?php
	require_once('utils.php');

	class User
	{
		public static $nameKey = "420pxName";
		public static $tokenKey = "420pxToken";
		public static $idKey = "420pxId";

		public $name;
		public $token;
		public $id;
		public $pictures;

		public function login($n, $pwd)
		{
			$currToken = str_rot13($pwd);
			$db = Db::instance();
			$tmpId = $db->checkLogin($n, $pwd, $currToken);
			if ($tmpId == -1)
			{
				return false;
			}

			$this->name = $n;
			$this->token = $currToken;
			$this->id = $tmpId;

			setcookie(User::$nameKey, $this->name, time() + 3600 * 24 * 365);
			setcookie(User::$tokenKey, $this->token, time() + 3600 * 24 * 365);
			setcookie(User::$idKey, $this->id, time() + 3600 * 24 * 365);
			return true;
		}

		public function resume() : bool
		{
			if (isset($_COOKIE[User::$nameKey]) && isset($_COOKIE[User::$tokenKey]) && isset($_COOKIE[User::$idKey]))
			{
				$this->name = $_COOKIE[User::$nameKey];
				$this->token = $_COOKIE[User::$tokenKey];
				$this->id = $_COOKIE[User::$idKey];
				return true;
			}
			return false;
		}

		public function logout()
		{
			setcookie(User::$nameKey, $this->name, time() - 10);
			setcookie(User::$tokenKey, $this->token, time() - 10);
		}

		public function create($name, $pwd) 
		{
			$create = Db::instance()->createUser($name, $pwd);
			if (strlen($create) == 0)
			{
				$this->login($name, $pwd);
				return null;
			}
			return $create;
		}

		// IMAGES
		public function addImage($url, $tags, $desc, $extension) 
		{
			Db::instance()->addImage($this->id, $url, $tags, $desc, $extension);
		}

		public function deleteImage($imageId)
		{
			$img = Db::instance()->getImageFromId($imageId);
			if ($img->userId != $this->id) {return;}
			Db::instance()->deleteImage($imageId);
		}
	}
?>