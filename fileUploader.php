<?php 

/**
 * 
 */
class FileUploader
{
	private static $target_directory = "uploads/";
	private static $size_limit = 50000;
	private $uploadOk = false;
	private $file_original_name;
	private $file_temp_name;
	private $file_type;
	private $file_size;
	private $final_file_name;

	function __construct($file_original_name,$file_temp_name,$file_size)
	{
		$this->file_original_name = $file_original_name;
		$this->file_temp_name = $file_temp_name;
		$this->file_size = $file_size;
	}

	public function setOriginalName($name)
	{
		$this->file_original_name = $name;
	}
	public function getOriginalName()
	{
		return $this->file_original_name;
	}
	public function setFileType($type)
	{
		$this->file_type = $type;
	}
	public function getFileType()
	{
		return $this->file_type;
	}
	public function setFileSize($size)
	{
		$this->file_size = $size;
	}
	public function getFileSize()
	{
		return $this->file_size;
	}
	public function setFinalFileName($final_name)
	{
		$this->final_file_name = $final_name;
	}
	public function getFinalFileName()
	{
		return $this->final_file_name;
	}





	public function uploadFile()
	{
		$this->setFinalFileName($this::$target_directory.basename($this->file_original_name));

		if ($this->fileTypeIsCorrect() && $this->fileSizeIsCorrect() && !$this->fileAlreadyExists()) {
			if (move_uploaded_file($this->file_temp_name, $this->getFinalFileName())) {
    			return true;
  			} 
		} 
		return false;
	}
	public function fileAlreadyExists()
	{
		if (file_exists($this->getFinalFileName())) {
 			return true;
		}
	}
	public function saveFilePathTo()
	{
		# code...
	}
	public function moveFile()
	{
		# code...
	}
	public function fileTypeIsCorrect()
	{
		$file_type = strtolower(pathinfo($this->getFinalFileName(),PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" )
			return false;
		//format
		$check = getimagesize($this->file_temp_name);
		
		if($check !== false) {
			return true;
  		} else {
  			return false;
  		}
	}
	public function fileSizeIsCorrect()
	{
		if ($this->file_size > $this::$size_limit) {
 			return false;
		}
		return true;
	}
	public function fileWasSelected()
	{
		# code...
	}
}



 ?>