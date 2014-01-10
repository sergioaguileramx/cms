# encoding: utf-8
############################################################################
#    Copyright (C) 2013 by Guillermo Valdes Lozano                         #
#    guivaloz@movimientolibre.com                                          #
#                                                                          #
#    This program is free software; you can redistribute it and#or modify  #
#    it under the terms of the GNU General Public License as published by  #
#    the Free Software Foundation; either version 2 of the License, or     #
#    (at your option) any later version.                                   #
#                                                                          #
#    This program is distributed in the hope that it will be useful,       #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of        #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         #
#    GNU General Public License for more details.                          #
#                                                                          #
#    You should have received a copy of the GNU General Public License     #
#    along with this program; if not, write to the                         #
#    Free Software Foundation, Inc.,                                       #
#    59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             #
############################################################################

#
# Clase Plantilla
#
class Plantilla

    #
    # Propiedades modificables
    #
    attr_writer :titulo_sitio, :frase_sitio, :grafico_encabezado, :menu_principal, :menu_secundario, :contenido_secundario, :pie_html, :archivo_rss

    #
    # Valores por defecto de las propiedades
    #
    def initialize
        # Propiedades modificables
        @titulo_sitio = 'Título del sitio'
        @frase_sitio  = 'Descripción del sitio'
    end

    #
    # Entrega el HTML de la página web
    #
    # titulo    es cadena de texto que se agrega al title
    # contenido es el contenido de la página en HTML
    # en_raiz   es boleano, verdadero si el archivo va a la raiz del sitio
    #
    public
    def to_html(titulo, contenido, en_raiz=false)
        a = Array.new
        a << '<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sergio Aguilera> Web Developer- Rubyholic - Githubber</title>'
        
        if en_raiz
                    a << '    <!-- Bootstrap core CSS -->
            <link href="/css/bootstrap.css" rel="stylesheet">
        
              
            <!--Fonts-->
            <link href=2http://fonts.googleapis.com/css?family=Raleway:400,200" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Exo+2:400,300" rel="stylesheet" type="text/css">
        
              
          
            <!-- Add custom CSS here -->
            <link href="/css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
            <!-- Page Specific CSS -->
            <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
          </head>'
                else
                    a <<'<!-- Bootstrap core CSS -->
            <link href="../css/bootstrap.css" rel="stylesheet">
        
              
            <!--Fonts-->
            <link href=2http://fonts.googleapis.com/css?family=Raleway:400,200" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Exo+2:400,300" rel="stylesheet" type="text/css">
        
              
          
            <!-- Add custom CSS here -->
            <link href="../css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
            <!-- Page Specific CSS -->
            <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
          </head>
        '
       end     
      a << '<body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index.html">Sergio Aguilera <i class="fa fa-angle-right"></i></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <div class="nav navbar-nav side-nav">
            <center class="webinfo">
              <h2 id="webinfo-title">Sergio Aguilera <i class="fa fa-angle-right"></i></h2>
              <h5 id="webinfo-text"> Web Developer - Githubber- Rubyholic</h5>
                </center>
                 
              <a href="http://twitter.com/sergioaaguilera" class="social"><i class="fa fa-twitter"></i> Twitter</a>
              
              <a  href="http://github.com/sergioaguilera" class="social"><i class="fa fa-github"></i> Github</a>
              
              <a  href="https://plus.google.com/u/0/102379541396197060774/posts?rel=author" class="social"><i class="fa fa-google-plus"></i>  Google+</a>
              
              <div class="social mail"></a><i class="fa fa-envelope"s></i> sergio@movimientolibre.com</div>

              <h3 id="webinfo-tags">Categorias </h3>
            <li><a href="/categorias/softwarelibre.html">Software libre</a></li>
            <li><a href="/categorias/github.html">GitHub</a></li>
            <li><a href="/categorias/desarrolloweb.html">Desarrollo Web</a></li>
            <li><a href="/categorias/personal.html">Personal</a></li>
              
              
            
                         

          </div>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
 
        <div class="row">
          <div class="col-lg-12">'
        a << '    <!-- CONTENIDO -->'
        a << "    <h1>#{titulo}</h1>"
        a << contenido
        a << '  </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->'
        if en_raiz
            a << '<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>'
            else
            a << '<!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="../js/morris/chart-data-morris.js"></script>
    <script src="../js/tablesorter/jquery.tablesorter.js"></script>
    <script src="../js/tablesorter/tables.js"></script>'
        end
        a << '</body>'
        a << '</html>'
        a.join("\n")
    end

end
