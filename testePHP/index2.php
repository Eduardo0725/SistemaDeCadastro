<?php
class criadorPerguntas
{
    public $enunciado; // onde ficará a pergunta
    public $alternativas; //onde ficarão as alternativas da pergunta
    public $conjunto; //onde ficarão as perguntas e alternativas

    public function setPergunta($perguntas)
    {
        //puxa o nome
        $nome = $_POST["nomeDoUsuario"];

        //É adicionado o caminho das variáveis em forma de string
        $img1 = './sangue.jpg';
        $img2 = './penso-logo-existo.png';
        $img3 = './chuveiro.jpg';
        $img4 = './mundo.jpeg';
        $img5 = './presidente.jpg';
        $img6 = './palavras.jpg';
        $img7 = './livros.png';
        $img8 = './casas-decimais-de-pi.jpg';
        $img9 = './quimica.jpg';
        $img10 = './paises.jpg';

        //É adicionado cada img em um array
        $imgs = [null, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $img9, $img10];

        //adiciona o 'h1' e o 'form' no '$this->conjunto'
        $this->conjunto = '<form action="index3.php" method="post"><h1 name="nomeDoUsuario" value="Eduardo">Questionário</h1>';

        //percorrer pelas perguntas, onde $i é o numero da pergunta e não do array
        for ($i = 1; $i <= 10; $i++) {
            $this->enunciado = strval($perguntas->$i->enunciado);
            $this->alternativas = null;

            //quant é a quantidade de alternativas que cada pergunta possui
            $quant = ['a', 'b', 'c', 'd', 'e'];

            //operador é o que define qual index do array será utilizado
            $operador = 0;

            //organiza as alternativa da pergunta
            foreach ($perguntas->$i->alternativas as $op) :

                //caso a $this->alternativa seja nula irá substituir o valor pela alternativa 'a', senão vai acrescentando as alternativas de 'b' à 'e'
                if ($this->alternativas != null) :
                    $operador = $operador + 1;
                    $this->alternativas = $this->alternativas . '<input type="radio" name="pergunta' . $i . '" value="' . $i . $quant[$operador] . '" >' . $quant[$operador] . ')' . $op . '<br/>';
                else : $this->alternativas = '<input type="radio" name="pergunta' . $i . '" value="' . $i . 'a" >' . 'a)' . $op . '<br/>';
                endif;

            endforeach;

            //no '$this->conjunto' é acrescentado uma 'div' para cada pergunta de acordo com o valor $i, um 'p' para cada enunciado numerado pelo valor $i, e as alternativas
            $this->conjunto = $this->conjunto . '<div id="perguntas' . $i . '"><img src="' . $imgs[$i] . '" style="width:250px; height:250px; border-radius:15px;">' . '<p>' . $i . ')' . $this->enunciado . '</p>' . $this->alternativas . '</div>';
        }

        //no '$this->conjunto' acresentado o 'input' com o nome do usuário de modo sorrateiro para poder passar para o outro arquivo php, também é acrescentado o 'button' e o 'form'
        $this->conjunto = $this->conjunto . '<input type="submit"></input><input type="hidden" name="nomeDoUsuario" value="' . $nome . '"></form>';

        //retorna '$this->conjunto'
        return $this->conjunto;
    }
}
//A variável '$perguntas' recebe o arquivo 'questoes.json' e é decodificado para objeto
$perguntas = json_decode(file_get_contents('questoes.json'));

$pergunta = new criadorPerguntas();

echo $pergunta->setPergunta($perguntas);
