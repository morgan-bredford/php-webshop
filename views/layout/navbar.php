<section class="header">
    <nav class="header_bar">
        <ul class="header_ul">
            <div class="header_logo">
                <a href="/" class="">
                    <li class="header_logo_text">
                        mb's webbshop
                    </li>
                </a>
            </div>
            <div class="header_search">
                <form method='get' action='/search' class="header_search_form">
                    <input type="text" name='searchString' class="header_search_input" placeholder="SÖK" />
                    <button class="header_search_button">
                        <img src="/images/search.png" class="header_search_image" />
                    </button>
                </form>
            </div>
            <div class="header_user">
                <?php
                if (!isset($_SESSION['user'])) {
                    $login = <<<LOGIN
                    <a href="/login">
                        <img src="/images/user.png" class="header_user_image" />
                        <li class="header_user_text">
                            logga in
                        </li>
                    </a>
                LOGIN;
                    echo $login;
                } else {
                    $firstname = $_SESSION['user']['firstname'];
                    $userOptions = <<<USEROPTIONS
                    <a href="/userpage">
                        <div class="x">
                            <img src="/images/user.png" class="header_user_image" />
                        </div>
                        <li class="header_user_text">
                            $firstname
                        </li>
                    </a>
                USEROPTIONS;
                    echo $userOptions;
                }
                ?>
            </div>
            <div class="header_cart">
                <li>
                    <img src="/images/cart.png" class="header_cart_image" />
                </li>
                <span class="header_cart_number">
                    <?= count($_SESSION['cart']) ?>
                </span>
                <div class="header_cart_cartname">varukorg</div>
            </div>
        </ul>
    </nav>
    <?php
    include_once $GLOBALS['ROOT_PATH'] . "/views/menu.php";
    include_once $GLOBALS['ROOT_PATH'] . "/views/cart.php";
    ?>
</section>
<main class="content_main">