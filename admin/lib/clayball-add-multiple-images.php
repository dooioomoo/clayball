<?php
if (!class_exists('Clayball_Add_Multiple_Images')) {

    class Clayball_Add_Multiple_Images
    {
        public function __construct()
        {
            $clayballsetting_multiple_images = get_option('clayballsetting_multiple_images', []);
            var_dump($clayballsetting_multiple_images);
        }
    }

    new Clayball_Add_Multiple_Images();
}