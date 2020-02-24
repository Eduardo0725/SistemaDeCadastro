<h4>Alunos</h4>
<a class="btn btn-primary" href="?pagina=home&action=add">
    <i class="fas fa-plus"></i>
    Cadastro
</a>
<a class="btn btn-primary" href="?pagina=home">
    Lista
</a>
<hr>
<?php
$action = '';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'insert') {
    $nome_alu = addslashes($_POST['nome_alu']);
    $email_alu = addslashes($_POST['email_alu']);
    $bd->query("insert into tb_aluno (nome_alu,email_alu) values ('$nome_alu','$email_alu')");
    $action = '';
}

if ($action == 'add') {
?>
    <form action="?action=insert" method="post" name="form1" id="form1">
        <label>Nome</label>
        <input type="text" name="nome_alu" id="nome_alu" class="form-control">
        <label>Email</label>
        <input type="text" name="email_alu" id="email_alu" class="form-control">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
        <a class="btn btn-light border border-secondary" href="?pagina=home">cancelar</a>
    </form>
    <?php
}

if ($action == 'update') {
    $id_aluno = addslashes($_POST['id_aluno']);
    $nome_alu = addslashes($_POST['nome_alu']);
    $email_alu = addslashes($_POST['email_alu']);
    $bd->query("update tb_aluno set nome_alu='$nome_alu',email_alu='$email_alu' where id_aluno='$id_aluno'");
    $action = '';
}

if ($action == 'edit') {
    $id_aluno = $_GET['id_aluno'];
    $bd->query("select * from tb_aluno where id_aluno=$id_aluno");
    foreach ($bd->result() as $dados) {
    ?>
        <h6>Editar</h6>
        <form action="?action=update" method="post" name="form1" id="form1">
            <input type="hidden" name="id_aluno" id="id_aluno" class="form-control" value="<?php echo $dados['id_aluno']; ?>">
            <label>Nome</label>
            <input type="text" name="nome_alu" id="nome_alu" class="form-control" value="<?php echo $dados['nome_alu']; ?>">
            <label>Email</label>
            <input type="text" name="email_alu" id="email_alu" class="form-control" value="<?php echo $dados['email_alu']; ?>">
            <br>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
            <a class="btn btn-light border border-secondary" href="#">cancelar</a>
        </form>
    <?php
    }
}

if ($action == 'delete') {
    $id_aluno = $_GET['id_aluno'];
    $bd->query("delete from tb_aluno where id_aluno=$id_aluno");
    $action = '';
}

if ($action == '') {
    $qt_por_paginas = 5;
    $sql = "select * from tb_aluno";
    $bd->query($sql);
    $total = $bd->linhas();
    $paginas = $total / $qt_por_paginas;
    $pg = 1;
    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $pg = $_GET['p'];
    }
    $p = ($pg - 1) * $qt_por_paginas;
    $anterior = $pg - 1;
    $proximo = $pg + 1;

    $bd->query("$sql LIMIT $p,$qt_por_paginas");
    if ($total == '') {
        echo 'Nenhum registro encontrado';
    } else {
    ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th align="center">Opções</th>
                </tr>
            </thead>
            <tbody>

                <?php
                echo 'Total de registros encontrados: ' . $total . '<br>';
                foreach ($bd->result() as $dados) {
                ?>
                    <tr>
                        <td><?php echo $dados['nome_alu']; ?></td>
                        <td><?php echo $dados['email_alu']; ?></td>
                        <td>
                            <a href="?action=edit&id_aluno=<?php echo $dados['id_aluno']; ?>"><i class="btn btn-primary fa fa-pencil-alt"></i></a>
                            <a href="?action=delete&id_aluno=<?php echo $dados['id_aluno']; ?>"><i class="btn btn-danger fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="mx-auto" style="max-width: 175px;">
            <ul class="pagination">
                <?php
                if ($pg > 1) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=<?php echo $anterior ?>">
                            &laquo;
                        </a>
                    </li>
                <?php
                }
                if($paginas > 1){
                    for ($i=1; $i <= $paginas; $i++) { 
                        if($pg == $i || $anterior < 0){
                            $cor = ' active';
                        }
                        else{
                            $cor = '';
                        }
                        ?>
                        <li class="page-item<?php echo $cor; ?>">
                        <a class="page-link" href="?p=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                        <?php
                    }
                }
                if ($pg < $paginas) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=<?php echo $proximo ?>">
                            &raquo;
                        </a>
                    </li>
                <?php
                }
                else{
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="?p=<?php echo $pg ?>">
                            <?php echo $pg; ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
<?php
    }
}
#class="text-center"
