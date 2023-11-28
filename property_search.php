<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);
    $price = floatval($_POST["price"]);
    $address = htmlspecialchars($_POST["address"]);
    $city = htmlspecialchars($_POST["city"]);
    $state = htmlspecialchars($_POST["state"]);
    $zip_code = htmlspecialchars($_POST["zip_code"]);
    $bedrooms = intval($_POST["bedrooms"]);
    $bathrooms = intval($_POST["bathrooms"]);
    $square_feet = intval($_POST["square_feet"]);
    $year_built = intval($_POST["year_built"]);
    $property_type = htmlspecialchars($_POST["property_type"]);
}
?>

<form id="propertyForm" action="property_search.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" required>

    <label for="zip_code">Zip Code:</label>
    <input type="text" id="zip_code" name="zip_code" required>

    <label for="bedrooms">Bedrooms:</label>
    <input type="number" id="bedrooms" name="bedrooms" required>

    <label for="bathrooms">Bathrooms:</label>
    <input type="number" id="bathrooms" name="bathrooms" required>

    <label for="square_feet">Square Feet:</label>
    <input type="number" id="square_feet" name="square_feet" required>

    <label for="year_built">Year Built:</label>
    <input type="number" id="year_built" name="year_built" required>

    <label for="property_type">Property Type:</label>
    <select id="property_type" name="property_type" required>
        <option value="apartment">Apartment</option>
        <option value="condo">Condominium</option>
        <option value="townhouse">Townhouse</option>
        <option value="bungalow">Bungalow</option>
    </select>

    <button type="button" onclick="submitForm()">Submit</button>
</form>