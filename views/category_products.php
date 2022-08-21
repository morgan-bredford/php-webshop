<h2 class="h2_categories">
    <?= $_SESSION['category'][0]['name'] ?>
</h2>
<section class="category_main">
    <?php foreach ($_SESSION['category'] as $product) : ?>
        <a href='product?id=<?= $product['id'] ?>' key=<?= $product['id'] ?>>
            <div class="product_preview">
                <h3 class="product_preview_h3"><?= $product['name'] ?></h3>
                <img src='/images/<?= $product['image'] ?>' class="product_preview_image" />
                <div class="product_preview_price">
                    <div>
                        <?= $product['price'] ?><span class="currency">kr</span>
                    </div>
                    <a href='category_products?category=<?= $_SESSION['category'][0]['category'] ?>&addToCart=<?= $product['id'] ?>'>
                        <div class="buy_button">
                            köp
                        </div>
                    </a>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</section>