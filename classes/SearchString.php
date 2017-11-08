<?php

/**
 * Holds a complete search string
 */
class Classes_SearchString {
	/**
	 * @var Classes_SearchString
	 */

	protected $search_string;

	/**
	 * Constructor
	 *
	 * @param string $search_string
	 */
	public function __construct($search_string) {
		$search_string = strtolower(trim($search_string));
		if(empty($search_string)) {
			throw new Exception("Empty search field");
		}
		else if (strlen($search_string) < 2){
			throw new Exception("Search string to short");
		}
		else {
			$this->search_string = $search_string;
		}
	}

	/**
	 *  Parses a search string into SubString objects
	 *
	 * @param array sub_string_array
	 * @return array
	 */
	public function parse_search_string() : array {
		//Array that holds all parsed sub strings from a search string
		$sub_string_array = [];
		$search_regex = '%(?:^|\s)(-?)(?:"([^"]+)"|([^\s]+))(?=(?:$|\s))%';

		preg_match_all($search_regex, $this->search_string, $sub_strings_matches, PREG_SET_ORDER);
		foreach ($sub_strings_matches as $sub_string_match) {
			$sub_string_array[] = Classes_SubStringFactory::create_sub_string($sub_string_match);
		}

		return $sub_string_array;
	}
}

?>
