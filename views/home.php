<?php $product = $_SESSION['product']; ?>
<section class="center_grid">
    <h1 class="home_h1">
        välkommen till<br />
        mb's webbshop
    </h1>
    <a href='product?id=<?= $product['id'] ?>'>
        <img src="/images/<?= $product['image'] ?>" class="product_image" />
    </a>
    <div>
        <strong><?= '[' . $product['name'] . ' ' . $product['price'] . 'kr]'; ?></strong>
    </div>
</section>