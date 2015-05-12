$(document).ready(function(){
    
    vemail = function (email) {
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
        if(er.exec(email)) {
            return true;
        } else {
            return false;
        }
    };
     
    email = $('input[name=email]');
        
    $('#submit').click(function(){
        vazio = 0;
        
        for (i = 0; i < $('.form').length; i++) {
            if ($('.form')[i].value === "") {
                $('.form')[i].classList.add('vazio');
                vazio++;
            } 
        }
        
        if (vazio === 0) {
            if (vemail(email.val())) {
                $('#submit').val("Enviando...").attr('id', '').addClass('ve');
                $.post("mail.php", $("form").serialize(),  function(response) {
                    $('form').fadeOut('slow');
                    $('#msg').html(response);
                    $('#resp').fadeIn('slow');
                });
            } else {
                email.addClass('vazio');
                $('#submit').addClass('ve').val('Digite um email válido');
            }
        } else {
            $('.vazio').blur();
            $('#submit').addClass('ve').val('Preencha todos os campos');
        }
        
        $('.vazio').click(function() {
            tiraVazio();
        });

        $('.vazio').focus(function() {
            tiraVazio();
        });

        tiraVazio = function () {
            $('.vazio').removeClass('vazio');
            $('#submit').val("Enviar").removeClass('ve');
        }
        
        return false;
    });
    $('#resp .v').click(function() {
        $('#resp').fadeOut('slow');
        $('input[type=submit]').attr('id','submit').val('Enviar').removeClass('ve');
        $('.form').val('');
        $('#submit').attr('class', 'v');
        $('form').fadeIn('slow');
    });
});