<?php
require_once 'simple_html_dom.php'; // Include the Simple HTML DOM library

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_link = $_POST['product_link'];

  // Fetch and parse the product information
  $product_info = getProductInformation($product_link);

  // Generate HTML markup for product display
  $html = '<div class="product">';
  $html .= '<h2>' . $product_info['title'] . '</h2>';
  $html .= '<p>' . $product_info['description'] . '</p>';
  $html .= '<p>Price: ' . $product_info['price'] . '</p>';
  $html .= '<img src="' . $product_info['image'] . '" alt="' . $product_info['title'] . '">';
  $html .= '</div>';

  // Return the product information as a response
  echo $html;
}

// Function to fetch and parse the product information
function getProductInformation($product_link) {
  // Create a DOM object using the product link
  $html = file_get_html($product_link);

  // Initialize variables for product information
  $title = '';
  $description = '';
  $price = '';
  $image = '';

  // Find and extract the product title
  $titleElement = $html->find('h1');
  if ($titleElement) {
    $title = $titleElement[0]->plaintext;
  }

  // Find and extract the product description
  $descriptionElement = $html->find('.product-description');
  if ($descriptionElement) {
    $description = $descriptionElement[0]->plaintext;
  }

  // Find and extract the product price
  $priceElement = $html->find('.product-price');
  if ($priceElement) {
    $price = $priceElement[0]->plaintext;
  }

  // Find and extract the product image URL
  $imageElement = $html->find('.product-image');
  if ($imageElement) {
    $image = $imageElement[0]->getAttribute('src');
  }

  // Clean up the extracted values if necessary

  // Create an array to hold the product information
  $product_info = array(
    'title' => $title,
    'description' => $description,
    'price' => $price,
    'image' => $image
  );

  // Clear the DOM object
  $html->clear();

  return $product_info;
}
?>
