<!DOCTYPE html>
<html>
    
    <head>
  
       
        <title>Admin Home Page</title>
      
        <!-- Bootstrap -->

        {!!Html::style('bootstrap/css/bootstrap.min.css')!!}
        {!!Html::style('bootstrap/css/bootstrap-responsive.min.css')!!}
        {!!Html::style('vendors/easypiechart/jquery.easy-pie-chart.css')!!}
        {!!Html::style('assets/styles.css')!!}
        {!!Html::script('vendors/modernizr-2.6.2-respond-1.1.0.min.js')!!}







        
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>


            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


       
   
    </head>

   <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Alquiler de Autos</a>
                    <div class="nav-collapse collapse">
                        @if(Auth::check())
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> {{Auth::user()->PrimerNombre}} <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">

                                    <li class="divider"></li>
                                    <li><div style="text-align: center;">

                                        {!!Form::open(['route'=>['Login.destroy'], 'method'=>'DELETE'])!!}

                                        {!!Form::submit('Cerrar Sesion', ['class'=>'btn btn-danger'])!!}
                                        {!!Form::close()!!}
                                        @endif
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="">
                                <a href="/Alquiler">Alquiler</a>
                            </li>
                            <li class="">
                                <a href="/Usuario">Clientes</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Datos Eliminados <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="/UsuariosEliminados">Usuarios

                                        </a>
                                    </li>
                                    @if(Auth::check())
                                    @if(Auth::user()->idTipoUsuario==1)
                                    <li>
                                        <a href="/ColorEliminado">Colores </a>
                                    </li>
                                    <li>
                                        <a href="/ModelosEliminados">Modelos</a>
                                    </li>

                                    <li>
                                        <a href="/MarcasEliminadas">Marcas</a>
                                    </li>
                                    <li>
                                        <a href="/VehiculosEliminados">Vehiculos</a>
                                    </li>
                                    <li>
                                        <a href="/EmpleadosEliminados">Empleados</a>
                                    </li>



                                </ul>

                            <li class="">
                                <a href="/ReportesAlquileres">Reportes</a>
                            </li>

                            </li>
                        @endif
                        @endif

                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <a href="/Alquiler"><i class="icon-chevron-right"></i> Alquiler</a>
                        </li>
                        <li>
                            <a href="/Usuario"><i class="icon-chevron-right"></i> Clientes</a>
                        </li>
                        <li>
                            <a href="/Vehiculo"><i class="icon-chevron-right"></i> Vehiculos</a>
                        </li>
                        <li>
                            <a href="/Color"><i class="icon-chevron-right"></i> Colores</a>
                        </li>
                        <li>
                            <a href="/Modelo"><i class="icon-chevron-right"></i> Modelos</a>
                        </li>
                        <li>
                            <a href="/Marca"><i class="icon-chevron-right"></i> Marcas</a>
                        </li>
                        @if(Auth::check())
                            @if(Auth::user()->idTipoUsuario==1)
                        <li>
                            <a href="/Empleado"><i class="icon-chevron-right"></i> Empleados</a>
                        </li>
                        @endif
                            @endif
                    </ul>
                </div>
                
                <!--/span-->


                    <div class="span9" id="content">
                    <div class="row-fluid">
                    <div class="block">



                @yield('content')



</div>
</div></div>



</div></div>
            </div>
            <hr>
            <footer>
                <p>UFG PRG4 ciclo 02 -2015</p>
            </footer>
        </div>
        <!--/.fluid-container-->
         
      

        {!!Html::style('vendors/datepicker.css')!!}
        {!!Html::style('vendors/uniform.default.css')!!}
        {!!Html::style('vendors/chosen.min.css')!!}
        {!!Html::style('vendors/wysiwyg/bootstrap-wysihtml5.css')!!} 


         {!!Html::script('vendors/jquery-1.9.1.js')!!}
         {!!Html::script('bootstrap/js/bootstrap.min.js')!!}

         {!!Html::script('vendors/jquery.uniform.min.js')!!}
         {!!Html::script('vendors/chosen.jquery.min.js')!!}
         {!!Html::script('vendors/bootstrap-datepicker.js')!!}
         {!!Html::script('vendors/wysiwyg/wysihtml5-0.3.0.js')!!}
         {!!Html::script('vendors/wysiwyg/bootstrap-wysihtml5.js')!!}
         {!!Html::script('vendors/wizard/jquery.bootstrap.wizard.min.js')!!}
         {!!Html::script('vendors/jquery-validation/dist/jquery.validate.min.js')!!}
         {!!Html::script('assets/form-validation.js')!!}
         {!!Html::script('assets/scripts.js')!!}


                <!--dynamic table-->
        <script type="text/javascript" language="javascript" src="{{ asset('js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/data-tables/DT_bootstrap.js') }}"></script>
        <!--dynamic table initialization -->
        <script src="{{ asset('js/dynamic_table_init.js') }}"></script>





</body>

</html>