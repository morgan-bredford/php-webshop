<h2 class="h2_categories">sökresultat</h2>
<section class="category_main">
<?php 
    if(!empty($_SESSION['searchProducts'])){
        foreach($_SESSION['searchProducts'] as $product): ?>
            <a href='product?id=<?= $product['id'] ?>' key=<?= $product['id'] ?>>
                <div class="product_preview">
                    <h3 class="product_preview_h3"><?= $product['name'] ?></h3>
                    <img src="/images/<?= $product['image'] ?>" class="product_preview_image" />
                    <div class="product_preview_price">
                        <div>
                            <?= $product['price'] ?>
                            <span class="currency">kr</span>
                        </div>
                        <a href='search?addToCart=<?= $product['id'] ?>'>
                            <div class="buy_button">
                                köp
                            </div>
                        </a>
                    </div>
                </div>
            </a>
<?php endforeach; ?>
<?php 
    } else {
        echo '<section class="no_search_result">Tyvärr, din sökning gav inget resultat</section>';
    }
?>
</section>