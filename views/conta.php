<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  

  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header" style="background-color:#1d0c5e">
                <h3 class="card-title">Minha conta</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <a href="<?php echo BASE_URL; ?>conta/meus_dados" title="Visualizar meus dados">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper">
                        <div class="ribbon bg-primary">
                          Conta
                        </div>
                      </div>
                      Dados da minha conta <br />
                      <small pointer="Acessar dados"><?php echo $_SESSION['name']; ?></small>
                      
                      
                    </div>
                    </a>
                  </div>

                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper">
                        <div class="ribbon bg-success">
                          Pedidos
                        </div>
                      </div>
                      Meus pedidos <br />
                      <small>.ribbon-wrapper.ribbon-lg .ribbon</small>
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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


</body>
</html>
