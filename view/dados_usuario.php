<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
<!--    <link rel="stylesheet" href="../view/dados-usuario.css">-->
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    body {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 300;
    }
    .apresentacao {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 20px 0px 40px;
        color: black;
        font-size: 15x;
        gap: 10px;
    }
    .titulo{
        font-size: 30px
    }
    .dados{
        display: flex;
        gap: 50px;
    }
    .sub{
        display: flex;
        flex-direction: column;
    }
    .bordas {
        padding: 0px;
        border: 1px solid;
        width: 50%;
        color: black;
        border-radius: 5px;
        width: 280px;
        height: 30px;
        margin: 0px 0px 10px 0px;
        text-align: center;
    }
    .botoes{
        border-radius: 10px;
        border: 0;
        width: 200px;
        padding: 10px;
        text-decoration: none;
        font-size: 15px;




        color: white;
        background-color: #0A3871;




        margin: 20px 300px 20px 120px;

    }
</style>


<body>
    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="dados-usuario.php">
       
        <p class="titulo">Sua conta</p>
        <div class="dados">
            <div class="sub">
                <label for="name" class="campos">Nome:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($nome); ?>" class="bordas" required>

                <label for="email" class="campos">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="bordas" required>

                <label for="genero" class="campos">Gênero:</label>
                <select id="genero" name="genero" class="bordas" required>
                    <option value="">Selecione</option>
                    <option value="Feminino" <?php echo ($genero == 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="Masculino" <?php echo ($genero == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                </select>
            </div>
            <div class="sub">
                <label for="cpf" class="campos">CPF:</label>
                <input type="cpf" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" placeholder="  _ _ _ . _ _ _ . _ _ _ - _ _" class="bordas" required>

                <label for="phone" class="campos">Telefone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="  (_ _) _ _ _ _ _ - _ _ _ _" class="bordas" required>            

                <label for="dt-nascimento" class="campos">Data de nascimento:</label>
                <input type="text" id="dt-nascimento" name="dt-nascimento" value="<?php echo htmlspecialchars($dt_nascimento); ?>" placeholder="  _ _ / _ _ / _ _ _ _" class="bordas" required>
            </div>
        </div>

        <p class="titulo">Seu endereço</p>
        <div class="dados">
            <div class="sub">
                <label for="endereco" class="campos">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>"class="bordas" required>

                <label for="bairro" class="campos">Bairro:</label>
                <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>" class="bordas" required>

                <label for="complemento" class="campos">Complemento:</label>
                <input type="text" id="complemento" name="complemento" value="<?php echo htmlspecialchars($complemento); ?>" class="bordas" required>

                <label for="numero" class="campos">Nº residência:</label>
                <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($numero); ?>" class="bordas" required>
            </div>
            <div class="sub">
            <label for="cep" class="campos">CEP:</label>
            <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($cep); ?>" placeholder="  _ _ _ _ _ - _ _ _" class="bordas" required>            

            <label for="cidade" class="campos">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" class="bordas" required>

                <label for="estado" class="campos">Estado:</label>
                <select id="estado" name="estado" value="<?php echo htmlspecialchars($estado); ?>"class="bordas" required>
                    <option value="">Selecione</option>
                    <option value="AC" <?php echo ($estado == 'AC') ? 'selected' : ''; ?>>AC</option>
                    <option value="AL" <?php echo ($estado == 'AL') ? 'selected' : ''; ?>>AL</option>
                    <option value="AP" <?php echo ($estado == 'AP') ? 'selected' : ''; ?>>AP</option>
                    <option value="AM" <?php echo ($estado == 'AM') ? 'selected' : ''; ?>>AM</option>
                    <option value="BA" <?php echo ($estado == 'BA') ? 'selected' : ''; ?>>BA</option>
                    <option value="CE" <?php echo ($estado == 'CE') ? 'selected' : ''; ?>>CE</option>
                    <option value="DF" <?php echo ($estado == 'DF') ? 'selected' : ''; ?>>DF</option>
                    <option value="ES" <?php echo ($estado == 'ES') ? 'selected' : ''; ?>>ES</option>
                    <option value="GO" <?php echo ($estado == 'GO') ? 'selected' : ''; ?>>GO</option>
                    <option value="MA" <?php echo ($estado == 'MA') ? 'selected' : ''; ?>>MA</option>
                    <option value="MT" <?php echo ($estado == 'MT') ? 'selected' : ''; ?>>MT</option>
                    <option value="MS" <?php echo ($estado == 'MS') ? 'selected' : ''; ?>>MS</option>
                    <option value="MG" <?php echo ($estado == 'MG') ? 'selected' : ''; ?>>MG</option>
                    <option value="PA" <?php echo ($estado == 'PA') ? 'selected' : ''; ?>>PA</option>
                    <option value="PB" <?php echo ($estado == 'PB') ? 'selected' : ''; ?>>PB</option>
                    <option value="PR" <?php echo ($estado == 'PR') ? 'selected' : ''; ?>>PR</option>
                    <option value="PE" <?php echo ($estado == 'PE') ? 'selected' : ''; ?>>PE</option>
                    <option value="PI" <?php echo ($estado == 'PI') ? 'selected' : ''; ?>>PI</option>
                    <option value="RJ" <?php echo ($estado == 'RJ') ? 'selected' : ''; ?>>RJ</option>
                    <option value="RN" <?php echo ($estado == 'RN') ? 'selected' : ''; ?>>RN</option>
                    <option value="RS" <?php echo ($estado == 'RS') ? 'selected' : ''; ?>>RS</option>
                    <option value="RO" <?php echo ($estado == 'RO') ? 'selected' : ''; ?>>RO</option>
                    <option value="RR" <?php echo ($estado == 'RR') ? 'selected' : ''; ?>>RR</option>
                    <option value="SC" <?php echo ($estado == 'SC') ? 'selected' : ''; ?>>SC</option>
                    <option value="SP" <?php echo ($estado == 'SP') ? 'selected' : ''; ?>>SP</option>
                    <option value="SE" <?php echo ($estado == 'SE') ? 'selected' : ''; ?>>SE</option>
                    <option value="TO" <?php echo ($estado == 'TO') ? 'selected' : ''; ?>>TO</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="id_end" value="<?php echo $id_end; ?>">

           
        <p class="titulo">Seu cartão</p>
        <div class="dados">
            <div class="sub">
                <label for="nome_cartao" class="campos">Nome:</label>
                <input type="text" id="nome_cartao" name="nome_cartao" value="<?php echo htmlspecialchars($nome_cartao); ?>" class="bordas" required>

                <label for="apelido" class="campos">Apelido:</label>
                <input type="text" id="apelido" name="apelido"  value="<?php echo htmlspecialchars($apelido); ?>" class="bordas" required>

                <label for="numero_cartao" class="campos">Número:</label>
                <input type="text" id="numero_cartao" name="numero_cartao" value="<?php echo htmlspecialchars($numero_cartao); ?>" class="bordas" required>
            </div>
            <div class="sub">
                <label for="categoria_cartao" class="campos">Tipo:</label>
                    <select id="categoria_cartao" name="categoria_cartao" value="<?php echo htmlspecialchars($categoria_cartao); ?>"class="bordas" required>
                        <option value="">Selecione</option>
                        <option value="credito" <?php echo ($categoria_cartao == 'credito') ? 'selected' : ''; ?>>Crédito</option>
                        <option value="debito" <?php echo ($categoria_cartao == 'debito') ? 'selected' : ''; ?>>Débito</option>
                    </select>

                <label for="dt_expedicao" class="campos">Data de expedição:</label>
                <input type="text" id="dt_expedicao" name="dt_expedicao" value="<?php echo htmlspecialchars($dt_expedicao); ?>"placeholder="  _ _ / _ _ / _ _ _ _"  class="bordas" required>

               <label for="cvv" class="campos">CVV:</label>
                <input type="text" id="cvv" name="cvv" value="<?php echo htmlspecialchars($cvv); ?>"placeholder="  _ _ _ " class="bordas" required>
            </div>
        </div>

            <input type="hidden" name="id_cartao" value="<?php echo $id_cartao; ?>">

            <button type="submit" name="atualizar" class="botoes">Atualizar</button>

        </form>
    </div>
</body>
</html>  