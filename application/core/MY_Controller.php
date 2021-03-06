<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	public function header() {
	    $this->_user['cmt01_firstname'] = $this->session->userdata('cmt01_firstname');
        $this->_user['cmt01_lastname']  = $this->session->userdata('cmt01_lastname');
        $this->_user['cmt01_email']     = $this->session->userdata('cmt01_email');

	    $this->load->view('admin/header', $this->_user);
	}

    public function footer()
    {
        $this->load->view('admin/footer');
    }

	public function is_logged_in(){
        $user = $this->session->userdata('cmt01_id_admin');
        if(isset($user)) {

        }
        else {
            redirect(base_url().'admin/signin');
        }
    }

  	public function getFont($familyRaw, $subtypeRaw = "normal")
    {
        static $cache = array();

        if (isset($cache[$familyRaw][$subtypeRaw])) {
            return $cache[$familyRaw][$subtypeRaw];
        }

        /* Allow calling for various fonts in search path. Therefore not immediately
         * return replacement on non match.
         * Only when called with NULL try replacement.
         * When this is also missing there is really trouble.
         * If only the subtype fails, nevertheless return failure.
         * Only on checking the fallback font, check various subtypes on same font.
         */

        $subtype = strtolower($subtypeRaw);

        if ($familyRaw) {
            $family = str_replace(array("'", '"'), "", strtolower($familyRaw));

            if (isset($this->fontLookup[$family][$subtype])) {
                return $cache[$familyRaw][$subtypeRaw] = $this->fontLookup[$family][$subtype];
            }

            return null;
        }

        $family = "serif";

        if (isset($this->fontLookup[$family][$subtype])) {
            return $cache[$familyRaw][$subtypeRaw] = $this->fontLookup[$family][$subtype];
        }

        if (!isset($this->fontLookup[$family])) {
            return null;
        }

        $family = $this->fontLookup[$family];

        foreach ($family as $sub => $font) {
            if (strpos($subtype, $sub) !== false) {
                return $cache[$familyRaw][$subtypeRaw] = $font;
            }
        }

        if ($subtype !== "normal") {
            foreach ($family as $sub => $font) {
                if ($sub !== "normal") {
                    return $cache[$familyRaw][$subtypeRaw] = $font;
                }
            }
        }

        $subtype = "normal";

        if (isset($family[$subtype])) {
            return $cache[$familyRaw][$subtypeRaw] = $family[$subtype];
        }

        return null;
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */