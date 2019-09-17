@extends('Layouts.master_login')

@section('content')
<div class="login-box">
    <div class='container'>
        <div class="row">
            <div class="col-md-6 d-none d-md-block" style="height: 70vh !important;">
                <div id='login-board' class="login-box-body login-board border-light" style="border: 10px solid; overflow: scroll;">
                    <div class="login-logo">
                        公佈欄
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%">#</th>
                                <th scope="col" style="width: 1%"></th>
                                <th scope="col">主旨</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_board as $_key => $_value)
                            <tr>
                                <td scope="row"> {{ $_key + 1 }} </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#board_modal_{{ $_key + 1 }}">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </td>
                                <td> {{ $_value['board_title'] }} </td>
                            </tr>

                            <div class="modal fade" id="board_modal_{{ $_key + 1 }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"> {{ $_value['board_title'] }} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            {{ htmlspecialchars_decode($_value['board_content'], ENT_QUOTES) }}
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 border-light">
                <div class="login-box-body" style="position:relative;">
                    <div class="login-logo">
                        <img>
                    </div>

                    <div style="position:absolute; bottom:15%; right: 7%; left:7%;">
                        <form method='POST' action='/' class='needs-validation'>
                            {{ csrf_field() }}
                            <!-- School -->
                            @if (count($connections) > 1)
                                <div class='form-group mb-3'>
                                    <select name='school' value='{{ old("school") }}'  class='form-control form-control-user' onchange=submit();>
                                @foreach ($connections as $key => $value)
                                    @if (old("school") === $key)
                                        <option value='{{ $key }}' selected>{{ $value }}</option>
                                    @else
                                        <option value='{{ $key }}'>{{ $value }}</option>
                                    @endif
                                @endforeach
                                    </select>
                                </div>
                            @else
                                <input type='hidden' name='school' value='{{ $connection["school"] }}'>
                            @endif

                            <!-- Account -->
                            <div class="input-group mb-3">
                                <input type='textbox' class='form-control' id='account' name='account' value='{{ old("account") }}' tabindex='1' placeholder='Account' required autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="input-group mb-3">
                                <input type='password' class='form-control' id='password' name='password' tabindex='2' placeholder='Password' required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class='form-group'>
                                    <div class='icheck-material-green form-check form-check-inline'>
                                        <input class='form-check-input' type='checkbox' name='remember'  id='remember-me'>
                                        <label class='form-check-label' for='remember-me' style='font-size: 1rem'>Remember Me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="social-auth-links text-center mb-3">
                                <button type='submit' name='event' value='login' class='btn btn-warning btn-lg btn-block' tabindex='4'>
                                    Login
                                </button>
                                <!-- <a href="#" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <strong>Copyright © ALLTOP 2019</strong>
    </footer>

</div>
@endsection

@section('javascript')
<script>
    $("#login-board").slimScroll({
        height: '100%',
        alwaysVisible: true,
    });
</script>
@endsection
