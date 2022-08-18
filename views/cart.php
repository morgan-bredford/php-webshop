<section class="cart_sidebar">
    <section class="cart_bar">
        <h3 class="h3_varukorg" style="text-align: center">varukorg</h3>
        <?php
        $price = 0;
        foreach ($_SESSION['cart'] as $arr_pos => $product) :
            $price += $product['price'];
        ?>
            <section class="cart_item">
                <img src="/images/<?= $product['image'] ?>" class="cart_image" />
                <a href="/product?id=<?= $product['id'] ?>">
                    <div class="cart_item_name">
                        <?= $product['name'] ?>
                    </div>
                </a>
                <!-- <div class="cart_inc_dec">-</div>
                        <div class="cart_item_quantity">
                            
                        </div>
                    <div class="cart_inc_dec">+</div> -->
                <div class="cart_item_price"><?= $product['price'] ?>
                    <span class="currency">
                        kr
                    </span>
                    <span>
                        <form method="post" action="" style='display:inline;'>
                            <input type="hidden" name="removeItem" value=<?= $arr_pos ?>>
                            <button>
                                X
                            </button>
                        </form>
                    </span>
                </div>
            </section>
        <?php endforeach; ?>
        <?php if (count($_SESSION['cart'])) {
            echo   '<section class="cart_total_price">
                            Totalpris: ' . $price . '
                            <span class="currency">kr</span>
                        <section class="cart_emptyingcart">
                        <form method="post" action="">
                        <input type="hidden" name="emptyCart" value="true">
                            <button class="buy_button cart_emptyingcart">
                                töm korgen
                            </button>
                        </form>
                        </section>
                        </section></section>';
        } else {
            echo '</section>
                    <div class="empty_basket">
                        du har inga varor i din korg
                    </div>';
        }
        ?>
    </section>