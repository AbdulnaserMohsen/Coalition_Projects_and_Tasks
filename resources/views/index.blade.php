<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <meta content="" name="keywords">
        <meta content="" name="description">

         <!-- Favicons -->
        <link href="{{ asset('img/logo_ico.png') }}" rel="icon">

        <title>Coalition Tasks</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  

        <!-- Libraries CSS Files -->
        <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Main Stylesheet File -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css'>
        <link href="{{ asset('css/drag.css') }}" rel="stylesheet">
        <link href="{{ asset('css/developer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/validation.css') }}" rel="stylesheet">
        

</head>

<body id="body">

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo"  class="float-left"  >
        <!-- <h1><a href="#body" class="scrollto">Reve<span>al</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{route('index')}}"><img src="{{ asset('img/logo.png') }}" alt="" title="" /></a>
        
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
            <li class="menu-active menu-has-children"><a href="#">Projects <i class="fa fa-chevron-down"></i></a>
                
                <ul>
                  @foreach($projects as $project)
                    <li><a name="project" href="{{route('get_project',$project->id)}}">{{$project->name}}</a></li>
                  @endforeach
                </ul>

            </li>
          
          

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
    <section id="services">
        <div class="container" id="container" data-url="{{route('get_project',$intial_project->id ?? '')}}">

            @foreach($tasks as $task)
            <div class="modal fade" id="modalEdit{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  
                  <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit Task</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form  class="validate-form" id="task_edit_{{$task->id}}" data-url="{{route('edit_task',$task->id)}}">
                        <div class="modal-body mx-3">
                            <div >
                                @csrf
                                <input type="hidden" name="proj_id" value="{{$intial_project->id ?? ''}}">
                                <div class="add-task-container validate-input" data-validate="Task should be english characters and numbers only" >
                                    <input type="text" id="taskText" name="name" placeholder="New Task..."  class="forms_field validate-input" value="{{$task->name}}">
                                </div>
                            </div>

                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="button edit-button">Edit <i class="fa fa-pencil"></i></button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            @endforeach

            <div class="section-header">
              <h2>{{$intial_project->name ?? ''}} Tasks</h2>
            </div>
            
            <form class="validate-form" id="task_add" data-url="{{route('add_task')}}">
                @csrf
                <input type="hidden" name="proj_id" value="{{$intial_project->id ?? ''}}">
                <div class="add-task-container validate-input" data-validate="Task should be english characters and numbers only">
                    <input type="text" id="taskText" name="name" placeholder="New Task..."  class="forms_field " >

                    <button type="submit" class="button add-button" >Add New Task</button>
                </div>
                
            </form>

            <div class="main-container">
              <ul class="columns">

                <li class="column tasks-column">
                  <div class="column-header">
                    <h4 >Tasks</h4>
                  </div>
                  <ul class="task-list " id="to-do" data-url="{{route('set_priority',':numbers')}}">
                    @foreach($tasks as $task)
                        <li class="task card " data-id="{{$task->id}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$task->name}}</h5>
                                <a href="#" class="text-white button edit-button" data-toggle="modal" data-target="#modalEdit{{$task->id}}">Edit <i class="fa fa-pencil"></i></a>
                                <a href="#" class="text-white button delete-button" data-url="{{route('delete_task', $task->id)}}">Delete <i class="fa fa-trash-o"></i></a>
                            </div>
                        </li>
                    @endforeach

                  </ul>
                </li>

              </ul>
            </div>

            
        </div>
    </section>
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    
    <!-- bottom footer -->
      <div id="bottom-footer" class="section">
        <div class="container">
          <!-- row -->
          <div class="row">
            <div class="col-md-12 text-center wow fadeInDown">
              
              <div class="developer">
                <h3 class="footer-title">Developed By</h3>
                <p><i class="fa fa-user"></i> Abdulnaser Ahmed Mohsen Mohamed</p>
                <p><i class="fa fa-map-marker"></i> Assiut,Assiut,Egypt</p>
                <p><i class="fa fa-mobile"></i> (+20) 1125567102</p>
                <p><i class="fa fa-envelope"></i> naserahmed1995@gmail.com</p>
                <a href="https://www.linkedin.com/in/abdulnaser-mohsen-7233a5103/"><i class="fa fa-linkedin"></i></a>
                <a href="https://github.com/AbdulnaserMohsen"><i class="fa fa-github"></i></a>
              </div>
              
            </div>
          </div>
          <!-- /row -->
          <div class="container">
            <div class="copyright">
              &copy; Copyright <strong>2020</strong>. All Rights Reserved
            </div>
          </div>
        </div>
        <!-- /container -->
      </div>
      <!-- /bottom footer -->

  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/easing/easing.min.js') }}"></script>


  <!-- Template Main Javascript File -->
  <script src="{{ asset('js/main.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js'></script>
  <script src="{{ asset('js/validation.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{ asset('js/ajax.js') }}"></script>

    </body>
</html>
