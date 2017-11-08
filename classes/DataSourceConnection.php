<?php

/**
 * Retrieves information and searches in data source
 */
class Classes_DataSourceConnection {
	/**
	 * @var Classes_DataSourceConnection
	 */
	protected $file_path;

	/**
	 * Constructor
	 *
	 * @param string $file_path
	 */
	public function __construct($file_path) {
		if (!file_exists($file_path)) {
			throw new Exception("File not found");
		} else {
			$this->file_path = $file_path;
		}
	}

	/**
	 * Search for products that matches all sub strings and returns an array of results
	 *
	 * @param array sub_strings
	 * @return array
	 */
	public function search_products($sub_strings, $result_list) {
		$products = $this->_parse_data_source();

		//Iterate through products and search sub strings to find and count matches
		foreach ($products as $product) {
			$relevance_weight = 0;
			foreach ($sub_strings as $sub_string) {
				$all_sub_string_match = true;
				$is_match = $sub_string->is_match($product);

				if ($is_match) {
					$relevance_weight += $sub_string->calculate_relevance_weight($product);
				} else {
					$all_sub_string_match = false;
					break;
				}
			}
			//If all sub string passed, add product to result list
			if ($all_sub_string_match) {
				$result_list->add_result($product, $relevance_weight);
			}
		}
	}

	/**
	 * Retrieves all products as a json object
	 *
	 * @return json
	 */
	private function _parse_data_source() {
		if ($data_table = file_get_contents($this->file_path)) {
			if (json_decode($data_table, true)) {
				return json_decode($data_table, true);
			}
			else {
				throw new Exception("File error");
			}
		} else {
			throw new Exception("File not found");
		}
	}
}

?>
