<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body>
<main>
    <h1>Contact</h1>

    <?php

    if (isset($_GET["err"])) {
        $err = $_GET["err"];
        if ($err == "incomplete") {
            ?> <p class="err-text">Unul dintre câmpurile obligatorii nu a fost completat!</p> <?php
        }
        else if ($err == "invalid") {
            if ($invalid == "first_name") {
                ?> <p class="err-text">Prenumele introdus este invalid!</p> <?php
            }
            else if ($invalid == "last_name") {
                ?> <p class="err-text">Numele introdus este invalid!</p> <?php
            }
            else if ($invalid == "email") {
                ?> <p class="err-text">Email-ul introdus este invalid!</p> <?php
            }
        }
        else if ($err == "error-email") {
            ?> <p class="err-text">A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.</p> <?php
        }
        else if ($err == "unchecked") {
            ?> <p class="err-text">Nu ați bifat checkbox-ul de recaptcha.</p> <?php
        }
    }

    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        if ($msg == "successful") {
            ?> <p class="succes-text">Mesajul dumneavoastră a fost trimis!</p> <?php
        }
    }

    ?>

    <form action="sendEmail.php" method="POST">
        <table class="form-table">
            <tbody>
                <tr>
                    <td><label>First Name: </label></td>
                    <td><input type="text" name="first_name" /></td>
                </tr>
                <tr>
                    <td><label>Last Name: </label></td>
                    <td><input type="text" name="last_name" /></td>
                </tr>
                <tr>
                    <td><label>Email: </label></td>
                    <td><input type="email" name="email" /></td>
                </tr>
            <tr><td colspan="2"><label>Your Message:</label></td></tr>
            <tr><td colspan="2"><textarea name="message" cols="70" rows="8"></textarea></td></tr>
            <tr><td colspan="2"><div class="g-recaptcha" data-sitekey="6LcE1v8ZAAAAAAtQcSVNJTxkPJzg-neQYVjygHtM"></div></td></tr>
            <tr><td colspan="2"><input type="submit" value="submit-message" /></td></tr>
            </tbody>
        </table>
    </form>
</main>
</body>
</html>