<?php

if( isset( $_GET['page'] ) ) {

    $data = $_GET['page'];

}
class Init {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function load_menu() {
        if ($this->data == 'home') {
            $home = array(
                'menu1' => 'Logo',
                'menu2' => 'Slider',
                'menu3' => 'Services',
                // 'menu4' => 'Cources',
                'menu5' => 'What_people_say',
                'menu6' => 'Features',
                'menu7' => 'FAQ',
            );
            return $home;
        }
        if ($this->data == 'about') {
            $about = array(
                'menu2' => 'Video_and_Content',
            );
            return $about;
        }
        if ($this->data == 'cources') {
            $cources = array(
                'menu1' => 'Add-cources',
                // 'menu2' => 'Videos',
                // 'menu3' => 'Categories',
            );
            return $cources;
        }
        if ($this->data == 'contact') {
            $contact = array(
                'menu1' => 'College-Info',
                'menu2' => 'Map',
            );
            return $contact;
        }
        if ($this->data == 'staff') {
            $staff = array(
                'menu1' => 'About-Staff',
            );
            return $staff;
        }
        if ($this->data == 'gallery') {
            $gallery = array(
                'menu1' => 'Add-Gallery',
            );
            return $gallery;
        }
    }
}
