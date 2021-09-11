<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * Layouts Class. PHP5 only. 
 * 
 */
class Layouts
{

    // Will hold a CodeIgniter instance 
    private $CI;

    // Will hold a title for the page, NULL by default 
    private $title_for_layout = NULL;

    // The title separator, ' | ' by default 
    private $title_separator = ' | ';

    private $includesJs = array();
    private $includesCss = array();

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function set_title($title)
    {
        $this->title_for_layout = $title;
    }

    public function view($view_name, $params = array(), $layout = 'default')
    {
        // Handle the site's title. If NULL, don't add anything. If not, add a  
        // separator and append the title.
        $separated_title_for_layout = "";
        if ($this->title_for_layout !== NULL) {
            $separated_title_for_layout = $this->title_separator . $this->title_for_layout;
        }

        // Load the view's content, with the params passed 
        $view_content = $this->CI->load->view($view_name, $params, TRUE);

        // Now load the layout, and pass the view we just rendered 
        $this->CI->load->view('layouts/' . $layout, array(
            'content_for_layout' => $view_content,
            'title_for_layout' => $separated_title_for_layout
        ));
    }

    public function add_include_js($path, $prepend_base_url = TRUE)
    {
        if ($prepend_base_url) {
            $this->CI->load->helper('url'); // Load this just to be sure 
            $this->includesJs[] = base_url() . $path;
        } else {
            $this->includesJs[] = $path;
        }

        return $this; // This allows chain-methods 
    }

    public function add_include_css($path, $prepend_base_url = TRUE)
    {
        if ($prepend_base_url) {
            $this->CI->load->helper('url'); // Load this just to be sure 
            $this->includesCss[] = base_url() . $path;
        } else {
            $this->includesCss[] = $path;
        }

        return $this; // This allows chain-methods 
    }

    public function print_includes_js()
    {
        // Initialize a string that will hold all includes 
        $final_includes = '';
        foreach ($this->includesJs as $include) {
            $final_includes .= '<script type="text/javascript" src="' . $include . '"></script>';
        }
        return $final_includes;
    }

    public function print_includes_css()
    {
        // Initialize a string that will hold all includes 
        $final_includes = '';
        foreach ($this->includesCss as $include) {
            $final_includes .= '<link href="' . $include . '" rel="stylesheet" type="text/css" />';
        }
        return $final_includes;
    }
}
