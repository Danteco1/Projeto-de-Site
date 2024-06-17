<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="main.js"></script>
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="Index.html"><img src="https://i.imgur.com/rwIXwDm.png" alt="logo"></a>
            </div>
            <div class="toggle">
                <a href="#"><ion-icon name="menu-outline"></ion-icon></a>
            </div>
            <ul class="menu">
                <li><a href="./Index.html">Home</a></li>
                <li><a href="Atuacao.html">Atuações</a></li>
                <li><a href="profissional.html">Profissionais</a></li>
                <li><a href="./formulario.php">Contato</a></li>
            </ul>
        </nav>
    </header>
    <div class="content">
        <a href="https://wa.me/message/BGC6FN57USMYK1" target="_blank" style="position:fixed;bottom:20px;right:30px;">
            <svg enable-background="new 0 0 512 512" width="50" height="50" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                <path d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z" fill="#4CAF50"/>
                <path d="m405.02 361.5c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.62-127.46-112.58-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016 0.16 8.576 0.288 7.52 0.32 11.296 0.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744s-7.36 7.68-11.136 12.352c-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z" fill="#FAFAFA"/>
            </svg>
        </a>
        <div class="contato">
            <h1>Formulario</h1>
            <div class="divform">
                <div class="conteudoadv">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Pega os dados do formulário
                        $name = htmlspecialchars($_POST['name']);
                        $email = htmlspecialchars($_POST['email']);
                        $phone = htmlspecialchars($_POST['phone']);
                        $message = htmlspecialchars($_POST['message']);
                        $recaptcha_response = $_POST['g-recaptcha-response'];

                        // Verifica o CAPTCHA
                        $secret_key = 'SUA_CHAVE_SECRETA';
                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha_response");
                        $response_keys = json_decode($response, true);

                        if (intval($response_keys["success"]) !== 1) {
                            echo "<p>Por favor, complete o CAPTCHA.</p>";
                        } else {
                            // Configurações do e-mail
                            $to = "seu_email@dominio.com";  // Substitua pelo seu endereço de e-mail
                            $subject = "Nova mensagem do formulário de contato";
                            $headers = "From: " . $email . "\r\n" .
                                       "Reply-To: " . $email . "\r\n" .
                                       "X-Mailer: PHP/" . phpversion();
                            
                            $body = "Nome: $name\n";
                            $body .= "E-mail: $email\n";
                            $body .= "Telefone: $phone\n\n";
                            $body .= "Mensagem:\n$message\n";

                            // Envia o e-mail
                            if (mail($to, $subject, $body, $headers)) {
                                echo "<p>Mensagem enviada com sucesso!</p>";
                            } else {
                                echo "<p>Erro ao enviar mensagem.</p>";
                            }
                        }
                    }
                    ?>
                    <form action="formulario.php" method="POST">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" placeholder="Digite seu nome" required>
                        <br>
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="exemplo@dominio.com.br" required>
                        <br>
                        <label for="phone">Telefone:</label>
                        <input type="tel" id="phone" name="phone" placeholder="(00)00000-0000" required>
                        <br>
                        <label for="mensage">Mensagem:</label>
                        <textarea id="text" name="message" cols="50" rows="6" placeholder="Sua mensagem" required></textarea>
                        <br>
                        <div class="g-recaptcha" data-sitekey="SUA_CHAVE_DO_SITE"></div>
                        <br>
                        <button class="enviar" type="submit" id="btn_enviar">Enviar</button>  
                    </form>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d234245.5129382951!2d-46.455211376094105!3d-23.457357143156354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cdcb64f7575fdf%3A0x5943c140ffef9d9d!2sEdificio%20Trade%20Center!5e0!3m2!1spt-BR!2sus!4v1717625500358!5m2!1spt-BR!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-content">
            <div class="imgroda"><img src="https://i.imgur.com/rwIXwDm.png" alt="imgroda"></div>
            <p class="footer-text">Rua Capitão José de Macedo 340, 5º andar, sala 503. Condominio Edíficio Trade Center Centro - Jacareí/SP<br>
            Email: contato@exemplo.com<br>
            Telefone: (11) 1234-5678</p>
        </div>
    </footer>
</div>
<script>
    $(function() {
        $(".toggle").on("click", function() {
            if ($(".menu").hasClass("active")) {
                $(".menu").removeClass("active");
                $(this).find("a").html('<ion-icon name="menu-outline"></ion-icon>');
            } else {
                $(".menu").addClass("active");
                $(this).find("a").html('<ion-icon name="close-outline"></ion-icon>');
            }
        });

        document.getElementById('phone').addEventListener('input', function (event) {
            const phoneInput = event.target;
            const phone = phoneInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            const formattedPhone = formatPhone(phone);
            phoneInput.value = formattedPhone;
        });

        function formatPhone(phone) {
            const dddRegex = /^(\d{2})/;
            const dddMatch = phone.match(dddRegex);

            if (dddMatch) {
                const ddd = dddMatch[1];
                const restOfNumber = phone.substr(ddd.length);
                return `(${ddd})${restOfNumber}`;
            } else {
                return phone;
            }
        }
    });
</script>
</body>
</html>