<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Seleção 3.0</a>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
                                <li><a href="#">Professores sem candidatos</a></li>                                
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
            <li class="dropdown" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    echo '<li><a href =' . SITE . '/relatorios/relatorio1.php target=_blank>Listagem de inscrições deferidas pela PRPGP</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio2.php target=_blank>Listagem de envelope recebidos</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio3.php target=_blank>Listagem de classificados - Etapa 1</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio4.php target=_blank>Listagem de não classificados - Etapa 1</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio5.php target=_blank>Listagem de indeferidos por não encaminhar envelope</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio6.php target=_blank>Listagem de indeferidos por não efetuarem inscrição</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio7.php target=_blank>Quadro estatístico</a></li>';
                    echo '<li><a href =' . SITE . '/relatorios/relatorio8.php target=_blank>Candidatos Por Avaliador - Comissão de Seleção</a></li>';
                    ?>
                </ul>
            </li>  
        </ul>

        <form class="navbar-form navbar-right" role="search">
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" 
                       data-toggle="dropdown" 
                       href="#">
                        <i class="fa fa-envelope fa-fw"></i> 
                        {Caixa Postal}
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">                    
                        <li>
                            <a href="#">
                                <div>
                                    <strong>{usuarioXXX}</strong>
                                    <span class="pull-right text-muted">
                                        <em>Ontem</em>
                                    </span>
                                </div>
                                <div>...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver todas das mensagens</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {<b><?php echo $_SESSION['nome'] ?></b>}<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a  onclick="chamaPerfil()"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo SITE ?>/avaliacao/?f=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>


    </div><!-- /.navbar-collapse -->

</nav>