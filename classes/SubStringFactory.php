<?php

/**
 * Factory for creating SubString objects
 */
class Classes_SubStringFactory {
	/**
	 * @var Classes_SubString
	 */

	static function create_sub_string($sub_string_match) {
		$sub_string = $sub_string_match[3];
		$is_negative_search = (bool) $sub_string_match[1];
		if (!empty($sub_string_match[2])) {
			$sub_string = $sub_string_match[2];
		}
		return new Classes_SubString($sub_string, $is_negative_search);
	}

}

?>
