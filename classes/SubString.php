<?php

/**
 * A formatted part of a search string
 */
class Classes_SubString {
	/**
	 * @var Classes_SubString
	 */

	protected $sub_string;
	protected $negative_search;

	/**
	 * Constructor
	 *
	 * @param string $sub_string
	 * @param boolean $negative_search
	 */
	public function __construct($sub_string, $negative_search = false) {
		$this->sub_string = $sub_string;
		$this->negative_search = $negative_search;
	}

	/**
	 * Checks if there is a match for this sub string
	 *
	 * @param string product
	 * @return boolean
	 */
	public function is_match($product) {
		$exact_id_search = $this->is_exact_search($product['produkt_id']);
		if ($this->is_negative() XOR (mb_stristr($product['produkt_namn'], $this->sub_string)
			|| mb_stristr($product['kategori_namn'], $this->sub_string)
			|| $exact_id_search)) {
			return true;
		}
		return false;
	}

	/**
	 * Returns true if search sub string is a negative search, else false
	 *
	 * @return boolean
	 */
	public function is_negative() {
		return $this->negative_search;
	}

	/**
	 * Returns true if search sub string is exactly like a certain string
	 *
	 * @return boolean
	 */
	public function is_exact_search($source_data_string) {
		return $source_data_string === $this->sub_string;
	}

	/**
	 * Returns weight of relevance of this sub string search for a specific search
	 *
	 * @param string product
	 * @return integer
	 */
	public function calculate_relevance_weight($product) {
		$relevance_weight = substr_count(strtolower($product['produkt_namn']), $this->sub_string)
			+ substr_count(strtolower($product['kategori_namn']), $this->sub_string);
		if($this->is_exact_search($product['produkt_id'])) {
			$relevance_weight++;
		}
		return $relevance_weight;
	}
}

?>
