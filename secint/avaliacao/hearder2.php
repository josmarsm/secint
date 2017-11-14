<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Seleção 3.0</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo SITE ?>/avaliacao/?p=home">Home</a></li>
            <?php
            if ($_SESSION['id_usuario'] == '1') {
                echo '
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href=' . SITE . '/avaliacao/?p=candidatos>Candidatos</a></li>
                                <li><a href="#">Lista de Candidatos - Não avaliados</a></li>
                                <li><a href="#">Aprovados</a></li>
                                <li><a href="#">Aprovados - Por orientador</a></li>
                                <li><a href="#">Aprovados - Por linha des pesquisa</a></li>
                                <li><a href="#">Aprovados - Por Classificação</a></li>                                
                            </ul>
                        </li>
                    ';
            }
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Avaliacao<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 3) {
                        echo '<li><a href =' . SITE . '/avaliacao/?p=comissao>Comissão de Seleção</a></li>';
                    }

                    if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 4) {
                        echo '<li><a href="' . SITE . '/avaliacao/?p=orientador">Orientador</a></li>';
                    }
                    ?>
                </ul>
            </li>   
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Lista de Candidatos</a></li>
                    <li><a href="#">Lista de Candidatos - Não avaliados</a></li>
                    <li><a href="#">Aprovados</a></li>
                    <li><a href="#">Aprovados - Por orientador</a></li>
                    <li><a href="#">Aprovados - Por linha des pesquisa</a></li>
                    <li><a href="#">Aprovados - Por Classificação</a></li>                                
                </ul>
            </li>  
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a ><span class="glyphicon glyphicon-user"></span> {<b><?php echo $_SESSION['nome'] ?></b>}</a></li>
            <li><a href="<?php echo SITE ?>/avaliacao/?f=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </ul>
    </div>
</nav>
