<?php
class Validacao
{
    public function validar()
    {

        //A variável '$nome' recebe o nome do usuario
        $nome = $_POST['nomeDoUsuario'];
        if ($nome) {
            $nome = $nome . ', ';
        }

        //A variável '$perguntas' recebe as respostas das perguntas respondidas, se não forem respondidas recebe null
        $perguntas = [
            isset($_POST["pergunta1"]) ? $_POST["pergunta1"] : null,
            isset($_POST["pergunta2"]) ? $_POST["pergunta2"] : null,
            isset($_POST["pergunta3"]) ? $_POST["pergunta3"] : null,
            isset($_POST["pergunta4"]) ? $_POST["pergunta4"] : null,
            isset($_POST["pergunta5"]) ? $_POST["pergunta5"] : null,
            isset($_POST["pergunta6"]) ? $_POST["pergunta6"] : null,
            isset($_POST["pergunta7"]) ? $_POST["pergunta7"] : null,
            isset($_POST["pergunta8"]) ? $_POST["pergunta8"] : null,
            isset($_POST["pergunta9"]) ? $_POST["pergunta9"] : null,
            isset($_POST["pergunta10"]) ? $_POST["pergunta10"] : null
        ];

        //A variável '$questoes' recebe o arquivo 'questoes.json' e é decodificado para objeto
        $questoes = json_decode(file_get_contents('questoes.json'));

        //Depois a variavel '$corretas' vai receber as respostas certas dentro de '$questoes'
        for ($i = 1; $i <= 10; $i++) {
            $corretas[] = $i . strval($questoes->$i->correct);
        }

        //A variável '$respostasCertas' é a quantidade de perguntas que o usuário acertou, e '$naoRespondidas' é a quantidade de perguntas não respondidas
        $respostasCertas = 0;
        $naoRespondidas = 0;
        for ($i = 0; $i <= 9; $i++) {
            if ($corretas[$i] === $perguntas[$i]) {
                $respostasCertas = $respostasCertas + 1;
            }
            if ($perguntas[$i] === null) {
                $naoRespondidas = $naoRespondidas + 1;
            }
        }

        //Se o usuário erre menos de 7 questões a variável '$resultado' receber o valor de reprovado , senão recebe aprovado
        if ($respostasCertas < 7) {
            $resultado = '<h1>Você foi reprovado</h1>';
        } else {
            $resultado = '<h1>Você foi aprovado</h1>';
        }

        //Transforma o valor do '$respostasCertas' em porcentagem
        $respostasCertas = strval($respostasCertas * 10) . '%';

        //O '$resultado' é acrescentado parte de uma mensagem com informações avaliativas
        $resultado = $resultado . '<span>' . $nome . 'você acertou ' . $respostasCertas . ' do questionário';

        //Se existir alguma pergunta que não foi respondida é acrescentado um valor em porcentagem indicando o mesmo, assim completando a mensagem, senão simplesmente a mensagem é completada
        if ($naoRespondidas > 0) {
            $naoRespondidas = strval($naoRespondidas * 10) . '%';
            $resultado = $resultado . ' e ' . $naoRespondidas . ' não respondidas.<span>';
        } else {
            $resultado = $resultado . '.<span>';
        }

        //retorna o '$resultado'
        return $resultado;
    }
}
$validacao = new Validacao();
echo $validacao->validar();
