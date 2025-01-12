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
                'menu3' => 'Services',
                'menu2' => 'All_Services',
                // 'menu4' => 'Cources',
                'menu5' => 'Testimonials',
                'menu8' => 'All_Testimonials',
                'menu6' => 'Features',
                'menu9' => 'All_Features',
                'menu7' => 'FAQ',
                'menu10' => 'All_FAQ',
            );
            return $home;
        }
        if ($this->data == 'about') {
            $about = array(
                'menu1' => 'All_Video_and_Content',
                'menu2' => 'Video_and_Content',
            );
            return $about;
        }
        if ($this->data == 'cources') {
            $cources = array(
                'menu1' => 'Add-cources',
                'menu2' => 'All_Cources',
                'menu3' => 'Meta_Setting',
                'menu4' => 'All_Meta_Datas',
                // 'menu2' => 'Videos',
                // 'menu3' => 'Categories',
            );
            return $cources;
        }
        if ($this->data == 'contact') {
            $contact = array(
                'menu3' => 'All_College_Info',
                'menu2' => 'Map',
            );
            return $contact;
        }
        if ($this->data == 'staff') {
            $staff = array(
                'menu1' => 'About-Staff',
                'menu2' => 'All_Staff',
            );
            return $staff;
        }
        if ($this->data == 'gallery') {
            $gallery = array(
                'menu1' => 'Add-Gallery',
                'menu2' => 'Gallery',
            );
            return $gallery;
        }
    }
}
