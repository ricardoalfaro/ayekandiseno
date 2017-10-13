<?php 
/**
 * @class Basic Google Fonts Class
 * this basic class will loop through the given fonts array 
 * @function return_fonts , this will return fonts names and variants / you need to set $instance = true when calling the class
 * @function return_font_by_id , this will return font name or variant by given $id 
 *  
 */


class Dsfgooglefonts
{

    private $id = '';
    private $fonts;


    function __construct($id = false, $instance = true) {
      require_once(dirname(__FILE__) . '/fonts.php');

      /**
       * If Id = false && $instance = true 
       * this will call return_fonts function 
       */
      if($id === false && $instance != false) {


          if($dsfGoogleFonts != '') 
          {
            $this->fonts = $dsfGoogleFonts;
          }
          else
          {
            $this->fonts = 'Error';
          }


          $this->return_fonts();

      }
      elseif($id != false) 
      {
          $this->id = $id;
          $this->fonts = $dsfGoogleFonts;
          $this->return_font_by_id;
      }

    }




    /**
     * @function return_fonts
     */
    public function return_fonts() {

        return $this->fonts;

    }


    /**
     * @funciton return_font_by_id
     */
    private function return_font_by_id() {

        if($this->id != '' && is_numeric($this->id)) {

            /**
             * Return The Specific Font By The ID
             */

        }
    }

}

?>