<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/usuarios">Usuários</a></li>
    <li class="active"><a href="/admin/usuarios/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/usuarios/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nomeusuario">Nome</label>
              <input type="text" class="form-control" id="nomeusuario" name="nomeusuario" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="emailusuario">E-mail</label>
              <input type="email" class="form-control" id="emailusuario" name="emailusuario" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
              <label for="senhausuario">Senha</label>
              <input type="text" class="form-control" id="senhausuario" name="senhausuario" placeholder="Digite a senha">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->