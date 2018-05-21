<?php

        $im = imagecreate(400, 200);
        $background_color = imagecolorallocate($im, 255, 255, 0);
        imagejpeg($im);
        
        header("Content-Type: image/jpeg");/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

