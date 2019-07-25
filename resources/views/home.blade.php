@extends('layouts.app')

@section('css')
    <style>
        .error-msg {
            color: #FA7C72;
            border-radius: 1rem;
            border: 1px solid #FA7C72;
            font-size: 18px;
            padding: 5px 10px;
        }
        .btn-primary {
             background-color: #7e57c2;
             border-color: #7e57c2;
        }
        .btn-primary:hover {
             background-color: #a459ea;
             border-color: #a459ea;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2" style="margin-top: 50px;">
                <div class="jumbotron">
                    <div class="errors">
                        @if ($errors->any())
                            <div style="text-align: center; line-height: 40px;">
                                @foreach ($errors->all() as $error)
                                    <p class="text-center error-msg"><i class="fa fa-exclamation-circle"
                                                                        aria-hidden="true"></i> {{$error}}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <h4 style="margin-bottom: 20px">Domain Search</h4>
                    <form id="target" action="/domain-search" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="text" name="domain" class="form-control form-control-lg"
                                       placeholder="company.com"
                                       value="{{ old('domain') }}" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-defalt btn-block btn-lg"><strong><i
                                                    class="fas fa-search"></i></strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p>Enter a domain name to find email addresses.</p>
                </div>
            </div>
        </div>
    </div>



    @if(!isset($mails))
    <div class="container desc">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <mark>DOMAIN SEARCH</mark>
                <h4>Get the email addresses behind any
                    website.</h4>
                <p style="font-size: 16px">The Domain Search lists all the people working in a company with their name
                    and email address found on the web. With 200+ million email addresses indexed, effective search
                    filters and scoring, it's the most powerful email-finding tool ever created.</p>
            </div>
        </div>
    </div>
    @endif


    @if(isset($mails))
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div style="margin-bottom: 10px; text-align: right">
                    <button class="btn btn-sm btn-primary" type="button">Copy All</button>
                    <button class="btn btn-sm btn-primary" type="button">Download CSV</button>
                </div>
                <ul class="list-group">
                    @foreach($mails as $mail)
                        <li class="list-group-item">{{$mail->mail}}
                            <span style="float: right">
                                <i title="copy" id="copy" onclick="copyMail(this)" class="fas fa-copy"></i>
                                <a title="verify" href="email-verifier/{{$mail->mail}}">
                                    <i class="fas fa-user-check"></i>
                                </a>
                                <a title="mailto" href="mailto:{{$mail->mail}}">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

@stop

@section('js')

    <script>
        function copyMail(elem) {
            var $body = document.getElementsByTagName('body')[0];
            var copyText = $(elem).closest("li").text().trim();

            var $tempInput = document.createElement('INPUT');
            $body.appendChild($tempInput);
            $tempInput.setAttribute('value', copyText);

            $tempInput.select();
            document.execCommand("copy");

            $body.removeChild($tempInput);
        }
    </script>
@stop