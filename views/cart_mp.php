
<script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>

<?php if(!empty($error)): ?>
<div class="col-sm-12">
	<?php echo "<p id='mensagem'>".$error.'</p>'; ?>
</div>
<?php endif; ?>

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


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h3>Preencha seus dados para prosseguir</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST" name="formulario">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="exampleInputName">Nome</label>
                    <input type="text" name="name" class="form-control" required placeholder="Seu nome completo!">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputCPF">CPF</label>
                    <input type="text" id="cpf" name="cpf" onblur="ValidarCPF(cpf)" class="radio1 form-control" placeholder="Seu CPF!">
                  </div>
                  
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control phone" required >
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Seu email">
                  </div>

                  <div class="form-group">
                    <label for="pass">Senha</label>
                    <input type="password" name="pass" id="pass" class="form-control" require placeholder="Digite uma senha!">
                  </div>

                  <div class="form-group">
                      <label for="pass_confirm">Confirme a Senha</label><br>
                      <input type="password" name="rep_senha" id="rep_senha" class="form-control" require placeholder="Confirme sua senha" />
                  </div>

                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1>Informações de Endereço</h1>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">CEP</label>
                    <input type="text" name="cep" class="form-control" require placeholder="Informe seu CEP">
                  </div>
                  <input type="hidden" name="admin" value=1>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cidade</label>
                    <input type="text" name="cidade" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Estado</label>
                    <input type="text" name="estado" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Logradouro</label>
                    <input type="text" name="rua" class="form-control"  require placeholder="Informe seu endereço">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" name="numero" class="form-control"  require placeholder="Número da sua casa">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Complemento</label>
                    <input type="text" name="complemento" class="form-control" placeholder="Casa, apto, etc...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Bairro</label>
                    <input type="text" name="bairro" class="form-control">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-muted mt-3">
                  <input type="submit" value="Efetuar Compra" class="button efetuarCompra" onclick="return validar()"/>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Versão</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.forcebulls.com.br">ForceBulls.com.br</a>.</strong> Todos os direitos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->