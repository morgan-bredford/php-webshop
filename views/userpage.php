<?php $user = $_SESSION['user']; ?>
<section>
    <br /><br />
    <div style="width: 30vw; margin: auto">
        <form class="login_form" method="post" action="">
            <h1 style="font-size: 2vw">Redigera dina uppgifter</h1>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?= $user['email'] ?>" placeholder="email" onChange={handleChange} />
            <br />
            <label htmlFor="firstname">Förnamn:</label>
            <input type="text" name="firstname" id="firstname" value="<?= $user['firstname'] ?>" placeholder="förnamn" onChange={handleChange} />
            <br />
            <label htmlFor="lastname">Efternamn:</label>
            <input type="text" name="lastname" id="lastname" value="<?= $user['lastname'] ?>" placeholder="efternamn" onChange={handleChange} />
            <br />
            <button style="cursor: pointer" name="update">
                Uppdatera
            </button>
        </form>
        <br />
        <Link href="/">
        <form action="" method="post">
            <input type="submit" name="logout" value="Logga ut" />
        </form>
        </Link>
    </div>

</section>