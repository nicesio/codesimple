<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Projetos
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Projetos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/projetos/<?php echo htmlspecialchars( $projeto["idprojeto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nomeprojeto">Nome do Projeto</label>
              <input type="text" class="form-control" id="nomeprojeto" name="nomeprojeto" placeholder="Digite o nome do projeto" value="<?php echo htmlspecialchars( $projeto["nomeprojeto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desprojeto">Descrição do Projeto</label>
              <input type="text" class="form-control" id="desprojeto" name="desprojeto" placeholder="Digite a descrição do projeto" value="<?php echo htmlspecialchars( $projeto["desprojeto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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