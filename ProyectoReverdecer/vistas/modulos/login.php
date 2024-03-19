<div class="back"></div>

<div class="login-box">
  <div class="login-logo">
        <img src="./vistas/img/sistema/logo_small.png" class="img-responsive" >
        <h1 class="text-primary">Iniciar Sesion</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
    <form  method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Ingresa usuario" name="usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"> Ingresar</i></button>
        </div>
        <!-- /.col -->
      </div>
      
      <?php
        $login= new ControladorEmpleados();
        $login -> ctrIngresoEmpleado();
      ?>
    </form>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->