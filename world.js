$(document).ready(function () {
	const lookupBtn = document.getElementById("lookup");
	const countryInput = document.getElementById("country");
	const result = document.getElementById("result");

	// listen for search button click
	$lookupButton.on("click", handleSearch);

	// Fetch the data by opening an Ajax connection to fetch data from world.php
	function handleSearch() {
		const rawInput = $searchInput.val().trim();
		//Create and sanitize user input
		const userInput = sanitizeInput(rawInput);

		//Create url with input as query parameter
		const url = userInput
			? //Make ajax call to world.php
			  `world.php?query=${encodeURIComponent(userInput)}`
			: "world.php";

		$.ajax({
			url: url,
			method: "GET",
			dataType: "html",
			success: function (data) {
				$result.html(data);
			},
			error: function () {
				//Display error msg
				$result.html("<p>Error fetching country data.</p>");
			},
		});
	}

	//Sanitize user input
	function sanitizeInput(str) {
		return str.replace(/[^a-zA-Z0-9\s'-]/g, "");
	}
});
