<?php

class Crop {
	private $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		}
	function resize($source, $new, $width, $height){
		$config = array(
				'image_library' => 'gd2',
				'source_image' => $source,
				'new_image' => $new,
				'maintain_ratio' => true,
				'width' => $width,
				'height' => $height,
		);
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->initialize($config);
		if ( ! $this->CI->image_lib->resize())
		{
			echo $this->CI->image_lib->display_errors();
		}
		$this->CI->image_lib->clear();
	}
	
	function crop_image($source, $new, $width, $height, $x, $y){
		$config = array(
				'image_library' => 'gd2',
				'source_image' => $source,
				'new_image' => $new,
				'maintain_ratio' => false,
				'width' => $width,
				'height' => $height,
				'x_axis' => $x,
				'y_axis' => $y
		);
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->initialize($config);
		if ( ! $this->CI->image_lib->crop())
		{
			echo $this->CI->image_lib->display_errors();
		}
		$this->CI->image_lib->clear();
	}
}