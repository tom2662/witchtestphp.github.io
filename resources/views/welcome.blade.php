<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Witchcaft Calculator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
   
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .title {
                font-size: 84px;
            }

            .links > a {
   
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;

            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .custom-row{
                padding-left:5%;
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                    Witchcraft Calculator
                </div>



                <div class="custom-row">
                    <form id="calculate">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Year of Death Person A</label>
                                <input type="number" class="form-control" name="yoda" required/>
                            </div>
                            <div class="form-group col-md-6">
                            <label>Age of Death Person A</label>
                                <input type="number" class="form-control" name="aoda" required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Year of Death Person B</label>
                                <input type="number" class="form-control" name="yodb" required/>
                            </div>
                            <div class="form-group col-md-6">
                            <label>Age of Death Person B</label>
                                <input type="number" class="form-control" name="aodb" required/>
                            </div>
                        </div>
                        <div class="custom-row">
                            <button type="submit" class="btn btn-outline-primary float-right">Calculate</button>
                        </div>

                    </form>
                </div>



            
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="resModal" role="dialog">
            <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Result</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
        
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>

        <!-- end of modal -->
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function(){    
            $("#calculate").submit(function(event){
            event.preventDefault();
                submitForm();
                return false;
            });
        });
        function submitForm(){

        var form = $('#calculate')[0];
        var dataForm = new FormData(form);

            jQuery.ajax({
                type: "POST",
                url: "{{url('/calc')}}",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                data: dataForm,
                success: function(response){
                        $('.modal-body').html(response);
                        $('#resModal').modal('show'); 
                },
                error: function(response){
                    $.each(response.responseJSON.errors,function(field_name,error){
                                $(document).find('[id=message]').append('<p class="alert-danger">' +error+ '</p>')
                            })
                            $('.modal-body').html(response);
                            $('#resModal').modal('show'); 

                            
                }
            });
        }

        </script>


</html>
