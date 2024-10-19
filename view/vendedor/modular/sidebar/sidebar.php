<?php
//    header("Refresh: 2s");
?>

<html lang="pt-br">
<body>
<aside>
    <div class="aside-container">
        <div class="aside-header">
            <div class="express-logo">
                <img src="/expressproject/view/vendedor/modular/sidebar/logo/logopreta.png" alt="express-logo">
            </div>
        </div>
        <div class="aside-body">
            <div class="aside-menu">
                <ul>
                    <li>
                        <a href="">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/home.svg" alt="" class="svg">
                            <span>Página Principal</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/receipt.svg" alt="" class="svg">
                            <span>Faturamento</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/arrows.svg" alt="" class="svg">
                            <span>Minhas Vendas</span>
                        </a>
                    </li>
                    <li>
                        <a href="../control/control_pagina-vendedor.php">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/box.svg" alt="" class="svg">
                           <span>Meus Produtos</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <ul>
                    <p>Configurações</p>
                    <li>
                        <a href="">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/gear.svg" alt="" class="svg">
                            <span>Configurações</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/expressproject/view/vendedor/modular/sidebar/svgs/leave.svg" alt="" class="svg">
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sealer-info">
            <div class="profile-pic">
                <img src="/expressproject/view/vendedor/modular/sidebar/user-logo/user.png" alt="profile-pic">
            </div>
            <div class="profile-info">
                <h3> <?php echo $_SESSION['nome']; ?></h3>
            </div>
        </div>
    </div>
</aside>
</body>
</html>
