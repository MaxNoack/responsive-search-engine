<?php

/**
 * A formatted part of a search string
 */
class Classes_SearchResultList {
	/**
	 * @var Classes_SearchResultList
	 */

	protected $list_of_results;

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->list_of_results = [];
	}

	/**
	 * Adds a product and its relevance weight to the result list
	 *
	 * @param array product_data
	 * @param array relevance_weight
	 */
	public function add_result($product_data, $relevance_weight) {
		$new_match = array_merge($product_data, ['relevance_weight' => $relevance_weight]);
		$this->list_of_results[] = $new_match;
	}

	/**
	 * Sorts the result list after relevance
	 *
	 */
	public function sort_descending() {
		array_multisort(array_column($this->list_of_results, 'relevance_weight'), SORT_DESC, $this->list_of_results);
	}

	/**
	 * Sorts the result list after relevance
	 *
	 */
	public function get_results() {
		return $this->list_of_results;
	}

}

?>
