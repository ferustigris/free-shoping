<?php
//! class for image files
class Picture {
	private $path;//! absolute path name
	/*! constructor
	 * \params
	 * - path - absolute path name
	 * \return no
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}
	/*! get absolute path name
	 * \params no
	 * \return no
	 */
	public function path()
	{
		return $this->path;
	}
	/*! move to
	 * \params
	 * - $new_path - move to
	 * \return no
	 */
	public function move($new_path)
	{
		move_uploaded_file($this->path(), $new_path);
		$this->path = $new_path;
	}
	/*! copy & resize
	 * \params
	 * - $new_path - copy to
	 * - w - weight
	 * - h- height
	 * \return no
	 */
	public function copy($new_path, $w, $h)
	{
		$im_source = imagecreatefromjpeg($this->path()) ;
		$im_dest = imagecreatetruecolor($w, $h) ;
		imagecopyresampled($im_dest, $im_source, 0,0,0,0, $w, $h, imagesx($im_source), imagesy($im_source)) ;
		imagejpeg($im_dest, $new_path, 75) ;
		imagedestroy($im_dest) ;
		imagedestroy($im_source) ;
		return new Picture($new_path) ;
	}
}
?>