 <?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
 
class JFormFieldLocation extends JFormField {
 
        protected $type = 'location';
 
        // getLabel() left out
 
        public function getInput() {
		$doc = JFactory::getDocument();
		$doc->addScript(JURI::root().'/modules/mod_kweather/assets/js/api.js');
		
		if (isset($this->value)) {
		    $location = $this->value;
		} else {
		    $location = "London";
		}
		$command = "myGeoPositionGeoPicker({startAddress : '" . $location . "', returnFieldMap   :{'" .$this->id . "' : '<LAT>, <LNG>'}});";
		$field = '<input type="hidden" id="' . $this->id . '" name="' . $this->name. '" value="' . $this->value . '"/>';
		$button = '<button type="button" onClick="' . $command . '"><img src="'.JURI::root().'/modules/mod_kweather/assets/images/map-16.png"></button>';
		
                return $field . $button;
        }
}
