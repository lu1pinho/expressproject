<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="../stylesheets/dados-usuario.css">
</head>

<body>
    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="dados-usuario.html">
        
        <p class="titulo">Sua conta</p>
        <div class="dados">
            <div class="sub">
                <label for="name" class="campos">Nome:</label>
                <input type="text" id="name" name="name" class="bordas" required>

                <label for="email" class="campos">Email:</label>
                <input type="email" id="email" name="email" class="bordas" required>

                <label for="genero" class="campos">Gênero:</label>
                <select id="genero" name="genero" class="bordas" required>
                    <option value="">Selecione</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>
            <div class="sub">
                <label for="cpf" class="campos">CPF:</label>
                <input type="cpf" id="cpf" name="cpf" placeholder="  _ _ _ . _ _ _ . _ _ _ - _ _" class="bordas" required>

                <label for="phone" class="campos">Telefone:</label>
                <input type="tel" id="phone" name="phone" placeholder="  (_ _) _ _ _ _ _ - _ _ _ _" class="bordas" required>            

                <label for="dt-nascimento" class="campos">Data de nascimento:</label>
                <input type="text" id="dt-nascimento" name="dt-nascimento" placeholder="  _ _ / _ _ / _ _ _ _" class="bordas" required>
            </div>
        </div>
            
        <p class="titulo">Seu endereço</p>
        <div class="dados">
            <div class="sub">
                <label for="endereco" class="campos">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="bordas" required>

                <label for="bairro" class="campos">Bairro:</label>
                <input type="text" id="bairro" name="bairro" class="bordas" required>

                <label for="complemento" class="campos">Complemento:</label>
                <input type="text" id="complemento" name="complemento" class="bordas" required>

                <label for="numero" class="campos">Nº residência:</label>
                <input type="text" id="numero" name="numero" class="bordas" required>
            </div>
            <div class="sub">
                <label for="cep" class="campos">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="  _ _ _ _ _ - _ _ _" class="bordas" required>            

                <label for="cidade" class="campos">Cidade:</label>
                <input type="text" id="cidade" name="cidade" class="bordas" required>

                <label for="estado" class="campos">Estado:</label>
                <select id="estado" name="estado" class="bordas" required>
                    <option value="">Selecione</option>
                    <option value="Acre">AC</option>
                    <option value="Alagoas">AL</option>
                    <option value="Amapa">AP</option>
                    <option value="Amazonas">AM</option>
                    <option value="Bahia">BA</option>
                    <option value="Ceara">CE</option>
                    <option value="Distrito-Federal">DF</option>
                    <option value="Esperito-Santo">ES</option>
                    <option value="Goias">GO</option>
                    <option value="Maranha">MA</option>
                    <option value="Mato-Grosso">MT</option>
                    <option value="Mato-Grosso-do-Sul">MS</option>
                    <option value="Minas-Gerais">MG</option>
                    <option value="Para">PA</option>
                    <option value="Paraiba">PB</option>
                    <option value="Parana">PR</option>
                    <option value="Pernambuco">PB</option>
                    <option value="Piaui">PI</option>
                    <option value="Rio-de-Janeiro">RJ</option>
                    <option value="Rio-Grande-do-Norte">RN</option>
                    <option value="Rio-Grande-do-Sul">RS</option>
                    <option value="Rondonia">RO</option>
                    <option value="Roraima">RR</option>
                    <option value="Santa-Catarina">SC</option>
                    <option value="Sao-Paulo">SP</option>
                    <option value="Sergipe">SE</option>
                    <option value="Tocantins">TO</option>
                </select>
            </div>
        </div>

            <button type="submit" class="botoes">Atualizar</button>
           
            <p class="titulo">Seus cartões</p>
        <div class="dados">
            <div class="fundo">
                    <label for="nome-cartao" class="campos">Nome:</label>
                    <input type="text" id="nome-cartao" name="nome-cartao" class="bordas" required>

                    <label for="apelido" class="campos">Apelido:</label>
                    <input type="text" id="apelido" name="apelido" class="bordas" required>

                    <label for="numero-cartao" class="campos">Número:</label>
                    <input type="text" id="numero-cartao" name="numero-cartao" class="bordas" required>

                    <label for="tipo-cartao" class="campos">Tipo:</label>
                    <select id="tipo-cartao" name="tipo-cartao" class="bordas" required>
                        <option value="">Selecione</option>
                        <option value="credito">Crédito</option>
                        <option value="debito">Débito</option>
                    </select>

                    <label for="dt-expedicao" class="campos">Data de expedição:</label>
                    <input type="text" id="dt-expedicao" name="dt-expedicao" placeholder="  _ _ / _ _ / _ _ _ _"  class="bordas" required>

                    <label for="cvv" class="campos">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="  _ _ _ " class="bordas" required>
            </div>
        </div>

            <button type="submit" class="botoes">Atualizar</button>
            <button type="submit" class="botoes">Adicionar</button>

        </form>
    </div>
</body>
</html>  