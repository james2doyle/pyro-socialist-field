<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PyroStreams socialist Field Type
 *
 * @package		PyroStreams
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2011 - 2013, PyroCMS
 */
class Field_socialist
{
	public $field_type_slug				= 'socialist';
	public $db_col_type					= 'text';
	public $version						= '1.0.0';
	public $custom_parameters		= array('social_list');
	public $author						= array('name'=>'James Doyle', 'url'=>'http://ohdoylerules.com');

	// --------------------------------------------------------------------------

	/**
	 * Output form input
	 *
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	public function form_output($data)
	{
		$networks = $data['custom']['social_list'];
		$template = '<ul>';
		// check if value is there
		if ($data['value']) {
			$values = unserialize($data['value']);
		}
		// count the networks array because they control which/how many inputs are avaliable
		for ($i=0; $i < count($networks); $i++) {
			// if a value is undefined then it was recently added and needs an empty string
			$values[$i] = (isset($values[$i])) ? $values[$i]: '';
			$template .= '<li><label for="'.$data['form_slug'].'">'.$networks[$i].'</label><div class="input"><input type="text" name="'.$data['form_slug'].'[]" value="'.$values[$i].'" id="'.$data['form_slug'].'"></div></li>';
		}
		return $template.'</ul>';
	}

	public function pre_save($input)
	{
		// Check for empty list
		// Don't serialze, use a flag for when we output later
		return (empty($input[0])) ? 0 : serialize($input);
	}

	/**
	 * Param Social List
	 *
	 * @access	public
	 * @param	[string - value]
	 * @return	string
	 */
	public function param_social_list($data = null)
	{
		$this->CI->type->add_js('socialist', 'socialist.js');
		// if data is already an array then we are in edit mode
		if (is_array($data)) {
			$template = '';
			foreach ($data as $item) {
				$template .= '<li class="streams_param_input"><label for="social_list">Network Name		</label><div class="input"><input type="text" name="social_list[]" value="'.$item.'">&nbsp;<a href="#" class="socialist_button">Add Another</a></div></li>';
			}
			return $template;
		} else {
			// first run
			return form_input('social_list[]', 'Network Name').'<a href="#" class="socialist_button">Add Another</a>';
		}
	}

	// BASE_URL + 'streams_core/public_ajax/field/socialist/get_field'
	public function ajax_get_field()
	{
		// return an input component
		echo '<li class="streams_param_input"><label for="social_list">Network Name		</label><div class="input"><input type="text" name="social_list[]" value="Network Name">&nbsp;<a href="#" class="socialist_button">Add Another</a></div></li>';
	}

	// --------------------------------------------------------------------------

	public function pre_output($input, $data)
	{
		// Check for empty list
		if ( ! $input)
		{
			return false;
		}
		$input = unserialize($input);
		if ($input) {
			$output = array();
			foreach ($input as $key => $value)
			{
				$output[] = array(
					'key'   => $data['social_list'][$key],
					'value' => $value,
				);
			}
			return $output;
		}
	}

}