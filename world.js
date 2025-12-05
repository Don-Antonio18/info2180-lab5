document.addEventListener("DOMContentLoaded", function () {
	const lookupButton = document.getElementById("lookup");
	const countryInput = document.getElementById("country");
	const resultDiv = document.getElementById("result");

	lookupButton.addEventListener("click", function () {
		const countryName = countryInput.value.trim();

		if (countryName === "") {
			resultDiv.innerHTML = "<p>Please enter a valid country name.</p>";
			return;
		}
		// OPEN AJAX CONNECTION TO FETCH DATA
		fetch("world.php?country=" + encodeURIComponent(countryName))
			.then((response) => response.text())
			.then((data) => {
				resultDiv.innerHTML = data;
			})
			.catch((error) => {
				resultDiv.innerHTML = "<p>Error fetching data.</p>";
				console.error("Error:", error);
			});
	});
});
