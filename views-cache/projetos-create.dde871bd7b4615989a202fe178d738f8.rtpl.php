<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Projetos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/projetos">Projetos</a></li>
    <li class="active"><a href="/admin/projetos/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Projeto</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/projetos/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nomeprojeto">Nome do Projeto</label>
              <input type="text" class="form-control" id="nomeprojeto" name="nomeprojeto" placeholder="Digite o nome do projeto">
            </div>
            <div class="form-group">
              <label for="desprojeto">Descrição do Projeto</label>
              <input type="text" class="form-control" id="desprojeto" name="desprojeto" placeholder="Digite a descrição do projeto">
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