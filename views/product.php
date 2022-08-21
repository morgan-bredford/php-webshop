<?php
$product = $_SESSION['product'];
$r_products = $_SESSION['related_products'];
$s_products = $_SESSION['seller_products'];
shuffle($r_products);
shuffle($s_products);
$related_products = array_slice($r_products, 0, 3);
$seller_products = array_slice($s_products, 0, 3);
?>
<section class="product_info">
    <section class="name_img_desc">
        <h1 class="product_name_h1">
            <?= $product['name'] ?>
        </h1>
        <section class="product_img">
            <img src="/images/<?= $product['image'] ?>" class="product_image" />
        </section>
        <section class="product_description">
            Beskrivning: <?= $product['description'] ?>
        </section>
    </section>
    <section>
        <div class="price_add_seller">
            <div class="product_preview_price">
                <div>
                    <?= $product['price'] ?>
                    <span class="currency">kr</span>
                </div>
                <a href='product?id=<?= $product['id'] ?>&addToCart=<?= $product['id'] ?>'>
                    <div class="buy_button">
                        köp
                    </div>
                </a>
            </div>
            <div class="product_seller">
                <?= $product['seller'] ?>
            </div>
        </div>
    </section>
    <section class="related">
        <h4 class="related_h4">--- relaterade produkter ---</h4>
        <?php foreach ($related_products as $rproduct) : ?>
            <a href="/product?id=<?= $rproduct['id'] ?>">
                <div class="product_preview">
                    <h3 class="product_preview_h3"><?= $rproduct['name'] ?></h3>
                    <img src="/images/<?= $rproduct['image'] ?>" class="product_preview_image" />
                    <div class="product_preview_price">
                        <div>
                            <?= $rproduct['price'] ?>
                            <span class="currency">kr</span>
                        </div>
                        <a href='product?id=<?= $product['id'] ?>&addToCart=<?= $rproduct['id'] ?>'>
                            <div class="buy_button">
                                köp
                            </div>
                        </a>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </section>
</section>
<section class="sellers_section">
    <h4 class="sellers_h4">
        FLER PRODUKTER FRÅN <?= $product['seller'] ?>:
    </h4>
    <?php foreach ($seller_products as $sproduct) : ?>
        <section class="sellers_products">
            <a href="/product?id=
                <?= $sproduct['id'] ?>
                ">
                <div class="product_preview">
                    <h3 class="product_preview_h3"><?= $sproduct['name'] ?></h3>
                    <img src="/images/<?= $sproduct['image'] ?>" class="product_preview_image" />
                    <div class="product_preview_price">
                        <div>
                            <?= $sproduct['price'] ?>
                            <span class="currency">kr</span>
                        </div>
                        <a href='product?id=<?= $product['id'] ?>&addToCart=<?= $sproduct['id'] ?>'>
                            <div class="buy_button">
                                köp
                            </div>
                        </a>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        </section>
</section>