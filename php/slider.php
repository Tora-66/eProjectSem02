<?php


echo '
<section id="cardSlider" class="section-margin cardSlider">
      <div class="carousel" data-flickity=\'{ "wrapAround": true }\'>';
while ($rcProduct = mysqli_fetch_array($rsProduct)) :
    echo '
        <div class="carousel-cell">
          <div class="card m-2" style="width: 18rem">
            <img src="' . $rcProduct[3] . '" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title">' . $rcProduct[1] . '</h5>
              <p class="card-text mx-auto">' . $rcProduct[5] . '</p>
              <button
                type="button"
                class="btn btn-dark btn-lg rounded-0 card-button"
              >
                <a href="productDetails.php?id=' . $rcProduct[0] . '"><i class="bi bi-cart2 me-2"></i> Add to cart</a>
              </button>
            </div>
          </div>
        </div>
        ';
endwhile;
echo ' </div>
</section>';
