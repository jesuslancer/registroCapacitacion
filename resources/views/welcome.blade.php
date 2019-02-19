<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <script src="{{ asset('css/app.css') }}"></script>
        <script src="{{ asset('js/Controller/registroCaptacionCtrl.js') }}"></script>         
    </head>
    <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    <body>
        <div id="captacion" class="flex-center position-ref full-height">
            <div>
                <form class="form-inline" @submit.prevent="consulta"   >
                    <div class="text-center col-lg-6 col-lg-offset-3">
                        <div class="form-group">
                            <label for="">Cédula de Identidad:</label>
                            <select class="form-control" v-model="nac">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div class="input-group" >
                            <input  maxlength="8"  data-vv-name="cédula" id="Cedula" v-model="cedula"  name="Cedula" type="text" class="form-control" title="Rellene este campo">
                            <div class="input-group-btn">
                                <button  type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search"></span> Buscar
                                </button>
                            </div>
                        </div><br>
                    </div>
                </form> 
            </div>
            <br>
            <div>
                <form class="form-control" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 form-group">
                            <label>Nombres y Apellidos:</label>
                            <input type="text"  class="form-control" v-model="nombrePersona" disabled>
                        </div>
                        <div class="col-lg-4 col-lg-push-2 form-group">
                            <label for="">Género:</label>
                            <input type="text" class="form-control" v-model="genero" disabled>
                        </div>
                        <div class="col-lg-4 col-lg-push-2 form-group">
                            <label for="">Fecha de Nacimiento:</label>
                            <input type="text" class="form-control" v-model="fechaNac" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
        <script src="{{ asset('js/app.js') }}"></script>
</html>
