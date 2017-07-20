<?php
	require_once('utils.php');

	class Db
	{
		private static $_instance;
		public static function instance(): Db
		{
			if (Db::$_instance == null)
			{
				Db::$_instance = new Db();
				Db::$_instance->init();
			}
			return Db::$_instance;
		}

		private $connection;

		public function init()
		{
			$dsn = 'mysql:host=mysql;dbname=420px';
    		$user = 'root';
    		$password = 'passroot';
    		$this->connection = new PDO($dsn, $user, $password);
		}

		public function checkLogin($name, $pwd, $token)
		{
			$select= $this->connection->query("SELECT * FROM User");
			$select->setFetchMode(PDO::FETCH_OBJ);

			while($user = $select->fetch()) 
			{
				if ($user->name == $name && $user->password == $pwd)
				{
					$this->connection->exec("UPDATE User SET token='".$token."' WHERE id=".$user->id);
					return $user->id;
				}
			}

			return -1;
		}

		public function getUserFromId($id)
		{
			$select= $this->connection->query("SELECT * FROM User WHERE id='".$id."'");
			$select->setFetchMode(PDO::FETCH_OBJ);

			while($user = $select->fetch()) 
			{
				return $user;
			}

			return null;
		}

		public function getImages($userId)
		{
			$array = array();

			$query = "SELECT * FROM Image";
			if ($userId > -1)
			{
				$query .= " WHERE userId='".$userId."'";
			}
			$select= $this->connection->query($query);
			$select->setFetchMode(PDO::FETCH_OBJ);

			while($image = $select->fetch()) 
			{
				$image->userName = $this->getUserFromId($image->userId)->name;
				$array[] = $image;
			}

			return $array;
		}

		public function getImageFromId($id)
		{
			$select= $this->connection->query("SELECT * FROM Image WHERE id='".$id."'");
			$select->setFetchMode(PDO::FETCH_OBJ);

			while($img = $select->fetch()) 
			{
				return $img;
			}

			return null;
		}

		public function getLastImageId()
		{
			$select= $this->connection->query("SELECT * FROM Image");
			$select->setFetchMode(PDO::FETCH_OBJ);

			$lastId = -1;
			while($img = $select->fetch()) 
			{
				$lastId = $img->id;
			}

			return $lastId;
		}

		public function deleteImage($id)
		{
			$img = $this->getImageFromId($id);
			unlink($img->url);

			$nb = $this->connection->exec("DELETE FROM Image WHERE id='".$id."'");
			return $nb >= 1;
		}

		public function addImage($userId, $image, $tags, $desc, $extension)
		{
			$path = Image::saveImageUploaded($userId, $image, $extension);
			if ($path == null) return false;

			$sql = "INSERT INTO Image (userId, url, tags, `desc`) VALUES ('".$userId."', '".$path."', '".$tags."', '".$desc."')";
			$nb = $this->connection->exec($sql);

			$imgObject = new Image($this->getLastImageId());
			$imgObject->resizeTo420px();

			return $nb >= 1;
		}

		public function createUser($name, $pwd)
		{
			$sql = "INSERT INTO User (name, password) VALUES ('".$name."', '".$pwd."')";
			$nb = $this->connection->exec($sql);
			return $nb >= 1 ? "" : "User already exists !";
		}

		public function updateImg($img, $source, $extension)
		{
			unlink($img->url);
			if ($extension == 'png')	imagepng($source, $img->url);
			else 						imagejpeg($source, $img->url);

			$sql = 'UPDATE Image SET url="'.$img->url.'", tags="'.$img->tags.'", `desc`="'.$img->desc.'" WHERE id="'.$img->id.'"';
			$nb = $this->connection->exec($sql);
			return $nb >= 1;
		}

	}
?>