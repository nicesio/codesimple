<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/usuarios/<?php echo htmlspecialchars( $usuario["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nomeusuario">Nome</label>
              <input type="text" class="form-control" id="nomeusuario" name="nomeusuario" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $usuario["nomeusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="senhausuario">Senha</label>
              <input type="text" class="form-control" id="senhausuario" name="senhausuario" placeholder="Digite a senha" value="<?php echo htmlspecialchars( $usuario["senhausuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="emailusuario">E-mail</label>
              <input type="email" class="form-control" id="emailusuario" name="emailusuario" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $usuario["emailusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->