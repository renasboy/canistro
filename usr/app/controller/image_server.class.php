<?php
namespace app\controller;

class image_server extends \app\simple_controller {

    // default input values in 
    // case no input is given
    protected $_default_input  = [
        'dir'       => [],
        'params'    => [],
        'image'     => []
    ];

    protected function _validate_input () {
        // validate the input param
        $this->_validator->validate('is_in_list',       $this->_input['dir'], ['product', 'category']);
        $this->_validator->validate('is_img_params',    $this->_input['params']);
        $this->_validator->validate('is_img_file',      $this->_conf->get('image_root') . '/' . $this->_input['dir'] . '/' . $this->_input['image']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('validation failed for image server: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        if ($this->_input['dir'] == 'images') {
            $img        = $this->_input['dir'] . '/' . $this->_input['image'];
        }
        else {
            $img        = $this->_conf->get('image_root') . '/' . $this->_input['dir'] . '/' . $this->_input['image'];
        }

        $content_type   = mime_content_type($img);

        switch ($content_type) {
            case 'image/jpeg':
                $original = imagecreatefromjpeg($img);
            break;

            case 'image/png':
                $original = imagecreatefrompng($img);
            break;

            case 'image/gif':
                $original = imagecreatefromgif($img);
            break;

            default:
                $original = imagecreatefromstring(file_get_contents($img));
            break;
        }
        
        $original_width     = imagesx($original);
        $original_height    = imagesy($original);

        preg_match('/^(crop|fit|scale)-([0-9]+|auto)x([0-9]+|auto)-(black|white)$/', $this->_input['params'], $matches);
        
        $mode   = $matches[1];
        $width  = $matches[2];
        $height = $matches[3];
        $color  = $matches[4];

        switch ($mode) {
            case 'crop':
                if ($height == 'auto') {
                    $height     = $width;
                }
                else if ($width == 'auto') {
                    $width      = $height;
                }

                if ($original_width > $original_height) {
                    $scale      = $original_height / $height;
                }
                else {
                    $scale      = $original_width / $width;
                }

                $scale_width    = round($original_width / $scale);
                $scale_height   = round($original_height / $scale);

                $top            = 0;
                $left           = 0;

                $original_top   = ($scale_height - $height) / 2 * $scale;
                $original_left  = ($scale_width - $width) / 2 * $scale;
            break;

            case 'fit':
                if ($height == 'auto') {
                    $height     = $width;
                }
                else if ($width == 'auto') {
                    $width      = $height;
                }

                if ($original_height > $original_width) {
                    $scale      = $original_height / $height;
                }
                else {
                    $scale      = $original_width / $width;
                }

                $scale_width    = round($original_width / $scale);
                $scale_height   = round($original_height / $scale);

                $top            = ($height - $scale_height) / 2; 
                $left           = ($width - $scale_width) / 2;

                $original_top   = 0;
                $original_left  = 0;
            break;

            case 'scale':
                if ($height == 'auto') {
                    $scale      = $original_width / $width;
                    $height     = round($original_height / $scale);
                }
                else if ($width == 'auto') {
                    $scale      = $original_height / $height;
                    $width      = round($original_width / $scale);
                }

                $scale_width    = $width;
                $scale_height   = $height;

                $top            = 0;
                $left           = 0;

                $original_top   = 0;
                $original_left  = 0;
            break;
        }

        $thumb  = imagecreatetruecolor($width, $height);

        switch ($color) {
            case 'white':
                $color = imagecolorallocate($thumb, 255, 255, 255);
            break;

            case 'black':
                $color = imagecolorallocate($thumb, 0, 0, 0);
            break;
        }
        
        imagefill($thumb, 0, 0, $color);

        imagecopyresampled(
            $thumb,
            $original,
            $left,
            $top,
            $original_left,
            $original_top,
            $scale_width,
            $scale_height,
            $original_width,
            $original_height
        );

        $dir    = $this->_conf->get('cache_root') . '/' . $this->_input['dir'] . '/' . $this->_input['params'];
        $image  = $dir . '/' . $this->_input['image'];

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // TODO probably the switch here should be in the extension
        switch ($content_type) {
            case 'image/jpeg':
                imagejpeg($thumb, $image, 90);
            break;

            case 'image/png':
                imagepng($thumb, $image);
            break;

            case 'image/gif':
                imagegif($thumb, $image);
            break;
        }

        imagedestroy($original);
        imagedestroy($thumb);
        
        $this->_view->set('content_type',   $content_type);
        $this->_view->set('img',            file_get_contents($image));
    }
}
