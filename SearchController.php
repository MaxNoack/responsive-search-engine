<?php
header('Content-Type: application/json');

function __autoload($class_name) {
	$path = str_replace("_", "/", $class_name);
	require_once $path . ".php";
}


try {
	$sub_string_array = [];
	$result_list = new Classes_SearchResultList();
	$data_source_connection = new Classes_DataSourceConnection("./data/products.json");
	$search_string = new Classes_SearchString($_POST['search_phrase']);
	$sub_string_array = $search_string->parse_search_string();
	$data_source_connection->search_products($sub_string_array, $result_list);
	$result_list->sort_descending();

	echo json_encode(
		array(
			"result_list" => $result_list->get_results()
		)
	);

//Through error if there's problem handling the request
} catch(Exception $e) {
	echo json_encode(
		array(
			"error_message" => $e->getMessage()
		)
	);
}

?>
