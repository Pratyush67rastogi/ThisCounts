<?php
// Make an HTTP request to fetch the HTML content
$html = file_get_contents($product_link);

// Create a DOMDocument object and load the HTML content
$dom = new DOMDocument();
libxml_use_internal_errors(true); // Disable error reporting for invalid HTML
$dom->loadHTML($html);
libxml_clear_errors(); // Clear any encountered errors

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_link = $_POST['product_link'];

  // Validate the product link if necessary

  // Fetch and parse the discounted price
  $discounted_price = getProductPrice($product_link);

  // Display the result
  echo "The discounted price of the product is $discounted_price";
}

// Function to fetch and parse the discounted price
// Function to fetch and parse the discounted price
function getProductPrice($product_link) {
  // Make an HTTP request to fetch the HTML content
  $html = file_get_contents($product_link);

  // Create a DOMDocument object and load the HTML content
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTML($html);
  libxml_clear_errors();

  // Find the element(s) containing the discounted price using XPath or other methods
  $xpath = new DOMXPath($dom);
  $discounted_price = '';

  // Example: Extract the discounted price using XPath
  $price_elements = $xpath->query('//span[contains(@class, "discounted-price")]');
  if ($price_elements->length > 0) {
    $discounted_price = $price_elements[0]->nodeValue;
  }

  // Example: Extract the discounted price by traversing the DOM tree
  /*
  $price_elements = $dom->getElementsByTagName('span');
  foreach ($price_elements as $element) {
    if (strpos($element->getAttribute('class'), 'discounted-price') !== false) {
      $discounted_price = $element->nodeValue;
      break;
    }
  }
  */

  // Clean up the price string if necessary (e.g., remove currency symbols or commas)

  return $discounted_price;
}

// Usage:
$product_link = $_POST['product_link'];
$discounted_price = getProductPrice($product_link);
echo "The discounted price of the product is $discounted_price";
?>

?>
