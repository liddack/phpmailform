<?php
    $email = $_POST["email"];
    $headers = array();
    $headers[] = 'From: Liddack Koding <liddack@koding.io>';
    $headers[] = 'X-Mailer: PHP/' . phpversion();
    $headers[] = 'Reply-To: ' . $email;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';
    
    $nome = $_POST["nome"];
    $assunto = $_POST["assunto"];
    $subj = '=?UTF-8?B?'.base64_encode("Formulário de Contato Koding - $nome").'?=';
    $msg = $_POST["msg"];
    $msg = "
        <html>
            <head>
                <style type='text/css'>
                    body {
                        font-family: sans-serif;
                    }
                    
                    #title {
                        text-align: center;
                        margin-top: 23px;
                    }
                    
                    #content {
                        border-top: 2px solid rgb(140, 140, 140);
                        padding-top: 27px;
                    }
                    
                    .campos span {
                        font-weight: bold;
                        margin-bottom: 7px;
                    }
                    
                    .campos div {
                        margin-top: 7px;
                        margin-bottom: 21px;
                        word-wrap: break-word;
                    }
                    
                    .campos {
                        margin: 0px 55px;
                    }
                </style>
            </head>
            <body>
                <div id='title'><center><h2>Formulário de Contato</h2></center></div>
                <div id='content'>
                    <div class='campos'>
                        <span>Nome:</span>
                        <div>$nome</div>
                    </div>
                    <div class='campos'>
                        <span>Email:</span>
                        <div>
                            <a href='mailto:$email'>$email</a>
                        </div>
                    </div>
                    <div class='campos'>
                        <span>Assunto:</span>
                        <div>$assunto</div>
                    </div>
                    <div class='campos'>
                        <span>Mensagem:</span>
                        <div>$msg</div>
                    </div>
                </div>
            </body>
        </html>
    ";
        
    if (mail('liddack@outlook.com', $subj, $msg, implode("\r\n", $headers))) {
        echo "A mensagem foi enviada!";
    } else {
        echo "Ocorreu um erro no envio.";
    }
?>