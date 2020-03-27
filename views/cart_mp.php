
<?php if(!empty($error)): ?>
<div class="col-sm-12">
	<?php echo "<p id='mensagem'>".$error.'</p>'; ?>
</div><br><br>
<?php endif; ?>

<div class="form-group col-sm-12">
<h1>Adicionar - Clientes</h1>
</div>

<!--<div class="col-sm-12">
<label class="form-group">
    Pessoa física
    <input type="radio" name="group1" class="radio1">
</label>
</div>
<div class="col-sm-12">
<label class="form-group">
    Pessoa jurídica
    <input type="radio" name="group1" class="radio2">
</label>
</div>-->

<?php if(isset($error_msg) && !empty($error_msg)): ?>
    <div class="aviso"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST" name="form1"   onsubmit="return validar()">

<div class="form-group col-sm-4">
    <label for="name">Nome <span style="color: red;">*</span></label><br/>
    <input type="text" name="name" onblur="myFunction()" id="fname" value="Evandro" required class="form-control" />
</div>

<div class="form-group col-sm-4">
    <div class="cpf content">
        <label for="cpf">CPF<span style="color: red;">*</span></label><br/>
        <input type="text" id="cpf" name="cpf" value="02477215906" require onblur="ValidarCPF(cpf)" class="radio1 form-control" />
    </div>
</div>

<!--<div class="cnpj content">
        <label for="cnpj">CNPJ<span style="color: red;"> #</span></label><br/>
        <input type="text" id="cnpj" name="cnpj" onblur="ValidarCPF(cnpj)" class="radio2" /><br/><br/>
</div>-->

<div class="form-group col-sm-4">
    <label for="telefone">Telefone<span style="color: red;">*</span></label><br>
    <input type="text" name="telefone" value="8399999999" class="form-control" require onblur="ValidaCelular(phone)" />
</div>
    
    <div class="form-group col-sm-6">
        <label for="email">E-mail<span style="color: red;">*</span></label><br/>
        <input type="email" name="email" require value="testemp@hotmail.com"  class="form-control"/>
    </div>

    <div class="form-group col-sm-3">
        <label for="pass">Senha<span style="color: red;">*</span></label><br>
        <input type="password" name="pass" id="pass" value="123" class="form-control" onblur="ValidarCampo(pass) require placeholder="Digite sua senha" />
    </div>

    <div class="form-group col-sm-3">
        <label for="pass_confirm">Confirme a Senha<span style="color: red;">*</span></label><br>
        <input type="password" name="pass_confirm" value="123" id="pass_confirm"  class="form-control" require placeholder="Confirme sua senha" />
    </div>

    <?php 
       if($_POST) {
        $pass = $_POST['pass'];
        $pass_confirm  = $_POST['pass_confirm'];
        if ($pass == "") {
            $mensagem = "<span class='col-sm-12 aviso'><b>Aviso</b>: Senha não foi inserida!</span>";
        } else if ($pass == $pass_confirm) {
            $mensagem = "<span class='col-sm-12 sucesso'><b>Sucesso</b>: As senhas são iguais.</span>";
        } else {
            $mensagem = "<span class='col-sm-12 erro'><b>Erro</b>: As senhas não conferem!</span>";
        }
        echo "<p id='mensagem'>".$mensagem."</p>";
    } 
    ?>

    <div class="form-group col-sm-12">
	    <h3>Informações de Endereço</h3>
    </div>

    <div class="form-group col-sm-3">
	<strong>CEP:<span style="color: red;"> *</span></strong><br/>
	<input type="text" name="cep" value="87490000" require class="form-control" /><br/><br/>
    </div>

    <div class="form-group col-sm-8">
	<strong>Cidade:</strong><br/>
	<input type="text" name="cidade" value="nova olimpia" class="form-control" /><br/><br/>
    </div>

    <div class="form-group col-sm-1">
	<strong>Estado:</strong><br/>
	<input type="text" name="estado" value="pr" class="form-control" /><br/><br/>
    </div>

    <div class="form-group col-sm-5">
	<strong>Rua:</strong><br/>
	<input type="text" name="rua" value="av ipiranga" class="form-control"  /><br/><br/>
    </div>

    <div class="form-group col-sm-2">
	<strong>Número:</strong><br/>
	<input type="text" name="numero" value="3416" class="form-control"  /><br/><br/>
    </div>

    <div class="form-group col-sm-2">
	<strong>Complemento:</strong><br/>
	<input type="text" name="complemento" value="casa" class="form-control" /><br/><br/>
    </div>

    <div class="form-group col-sm-3">
	<strong>Bairro:</strong><br/>
	<input type="text" name="bairro" value="centro" class="form-control"  /><br/><br/>
    </div>

    
    <div class="form-group col-sm-6">
	<input type="submit" value="Efetuar Compra" class="button efetuarCompra" />
    </div>

</form>

<!--<h3>Dados Pessoais</h3>

<form method="POST">
	<strong>Nome:</strong><br/>
	<input type="text" name="name" value="Evandro" /><br/><br/>

	<strong>CPF:</strong><br/>
	<input type="text" name="cpf" value="05347965401" /><br/><br/>

	<strong>Telefone:</strong><br/>
	<input type="text" name="telefone" value="8399999999" /><br/><br/>

	<strong>E-mail:</strong><br/>
	<input type="email" name="email" value="testemp@hotmail.com" /><br/><br/>

	<strong>Senha:</strong><br/>
	<input type="password" name="pass" value="123" /><br/><br/>

	<h3>Informações de Endereço</h3>

	<strong>CEP:</strong><br/>
	<input type="text" name="cep" value="58410340" /><br/><br/>

	<strong>Rua:</strong><br/>
	<input type="text" name="rua" value="Rua Vigário Calixto" /><br/><br/>

	<strong>Número:</strong><br/>
	<input type="text" name="numero" value="1400" /><br/><br/>

	<strong>Complemento:</strong><br/>
	<input type="text" name="complemento" /><br/><br/>

	<strong>Bairro:</strong><br/>
	<input type="text" name="bairro" value="Catolé" /><br/><br/>

	<strong>Cidade:</strong><br/>
	<input type="text" name="cidade" value="Campina Grande" /><br/><br/>

	<strong>Estado:</strong><br/>
	<input type="text" name="estado" value="PB" /><br/><br/>

	<input type="submit" value="Efetuar Compra" class="button efetuarCompra" />
</form>-->