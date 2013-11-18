<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

/**
* Validate class
*
* Validate input fields
*
* @package      OpenPhpCms
* @subpackage   Core
* @category     Core
* @author       Maikel Martens
*/
// ------------------------------------------------------------------------
class Library_InputValidate {
    private $validations    = array();
    private $validatorTypes = array('numeric', 'alphabet' ,'alphanumeric', 'email', 'none');
    private $properties     = array('empty', 'minlength', 'maxlength');

    /**
    * add
    *
    * Add input to validations 
    *
    * @access public
    * @param string inputName
    * @param string value
    * @param string validatorType
    * @param string properties
    * @return void
    */
    public function add($inputName, $value, $validatorType, $properties = ''){
        $validate = array('input' => $inputName 
                         ,'value'=> $value
                         ,'type' => strtolower($validatorType) 
                         ,'properties' => array());

        if(!in_array(strtolower($validatorType), $this->validatorTypes))
            throw new Exception("ERROR in Validate: validatorType does not exist!", 1);


        if(strlen($properties) > 0) {

            $properties_temp = explode(';', $properties);
            $properties_arr = array();

            foreach ($properties_temp as $value) {

                $prop_arr = explode('=', $value);
                if(isset($prop_arr[0]) && isset($prop_arr[1])){

                    $property   = strtolower( trim($prop_arr[0]) );
                    $value      = strtolower( trim($prop_arr[1]) );
                    
                    $properties_arr[$property]  = $value;
                    
                    if(empty($property) || empty($value) || !in_array($property, $this->properties))
                        throw new Exception("ERROR in Validate: not an valid property is given!", 1);

                } else {
                    throw new Exception("ERROR in Validate: not an valid property is given!", 1);
                }
            }
            $validate['properties'] = $properties_arr;
        }
        $this->validations[] = $validate;
    }


    /**
    * validate
    *
    * Validate all the added validations and give back an array with errors.
    *
    * @access public
    * @return array
    */
    public function validate(){
        $errors = array();
        foreach ($this->validations as $validate) {
            
            $method = 'type_'.$validate['type'];
            $result = $this->$method($validate['value']);
            
            if($result !== false)
                $errors[$validate['input']][] = $result;

            foreach ($validate['properties'] as $prop => $prop_value) {
                $method = 'prop_'.$prop;
                $result = $this->$method($prop_value, $validate['value']);
                if($result !== false)
                    $errors[$validate['input']][] = $result;
            }
        }
        return $errors;
    }

    /**
    * type_numeric
    *
    * When value is not numeric returns error message.
    * Else false; 
    *
    * @access public
    * @param String value
    * @return String/boolean
    */
    private function type_numeric($value){
        if(!is_numeric($value))
            return 'No valid numeric number!';
        return false;
    }

    /**
    * type_alphabet
    *
    * When value is not alphabet returns error message.
    * Else false; 
    *
    * @access public
    * @param String value
    * @return String/boolean
    */
    private function type_alphabet($value){
        if (preg_match('/[^a-zA-Z]/i', $value))
            return 'Not alphabetically!';
        return false;
    }

    /**
    * type_alphanumeric
    *
    * When value is not alphanumeric returns error message.
    * Else false; 
    *
    * @access public
    * @param String value
    * @return String/boolean
    */
    private function type_alphanumeric($value){
        if (preg_match('/[^a-zA-Z0-9]/i', $value))
            return 'Not alphanumeric!';
        return false;
    }

    /**
    * type_email
    *
    * When value is not email returns error message.
    * Else false; 
    *
    * @access public
    * @param String value
    * @return String/boolean
    */
    private function type_email($value){
        $regexEmail = '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
        if ($value != '' && !preg_match($regexEmail, $value))
            return 'Not a valid email!';
        return false;
    }

    /**
    * type_none
    *
    * Always retuns false
    *
    * @access public
    * @param String value
    * @return boolean
    */
    private function type_none($value){
        return false;
    }

    /**
    * prop_empty
    *
    * When value is empty returns error message.
    * Else false; 
    *
    * @access public
    * @param String property
    * @param String value
    * @return String/boolean
    */
    private function prop_empty($property, $value){
        if($property == 'false' && $value == '')
            return 'Can not be empty!';
        return false;
    }

    /**
    * prop_minlength
    *
    * When value is not given minlength returns error message.
    * Else false; 
    *
    * @access public
    * @param String property
    * @param String value
    * @return String/boolean
    */
    private function prop_minlength($property, $value){
        if(is_numeric($property) && strlen($value) < $property )
            return str_replace('[property]', 'Must be longer than [property] characters!');
        return false;
    }

    /**
    * prop_maxlength
    *
    * When value is not given maxlength returns error message.
    * Else false; 
    *
    * @access public
    * @param String property
    * @param String value
    * @return String/boolean
    */
    private function prop_maxlength($property, $value){
        if(is_numeric($property) && strlen($value) > $property )
            return str_replace('[property]', 'Should not be longer than [property] characters!');
        return false;
    }
}
/* End of file Validate.php */
/* Location: ./application/lib/Validate.php */