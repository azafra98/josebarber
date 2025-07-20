<html>
<head>
    <title>ERROR 404!!</title>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Gilda+Display);

        html {
            background: #000000;
            color: white;
            overflow: hidden;
            user-select: none;
        }

        .error {
            text-align: center;
            font-family: 'Gilda Display', serif;
            font-size: 95px;
            font-style: italic;
            text-align: center;
            width: 100px;
            height: 60px;
            line-height: 60px;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: -60px;
            right: 0;
            animation: noise 2s linear infinite;

        }

        .error:after {
            content: '404';
            font-family: 'Gilda Display', serif;
            font-size: 100px;
            font-style: italic;
            text-align: center;
            width: 150px;
            height: 60px;
            line-height: 60px;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0;
            color: blue;
            animation: noise-1 .2s linear infinite;
        }

        .info {
            text-align: center;
            font-family: 'Gilda Display', serif;
            font-size: 15px;
            font-style: italic;
            text-align: center;
            width: 200px;
            height: 60px;
            line-height: 60px;
            margin: auto;
            position: absolute;
            top: 140px;
            bottom: 0;
            left: 0;
            right: 0;
            animation: noise-3 1s linear infinite;
        }

        .error:before {
            content: '404';
            font-family: 'Gilda Display', serif;
            font-size: 100px;
            font-style: italic;
            text-align: center;
            width: 100px;
            height: 60px;
            line-height: 60px;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0;
            color: red;
            animation: noise-2 .2s linear infinite;
        }

        @keyframes noise-1 {
            0%, 20%, 40%, 60%, 70%, 90% {opacity: 0;}
            10% {opacity: .1;}
            50% {opacity: .5; left: -6px;}
            80% {opacity: .3;}
            100% {opacity: .6; left: 2px;}
        }

        @keyframes noise-2 {
            0%, 20%, 40%, 60%, 70%, 90% {opacity: 0;}
            10% {opacity: .1;}
            50% {opacity: .5; left: 6px;}
            80% {opacity: .3;}
            100% {opacity: .6; left: -2px;}
        }

        @keyframes noise {
            0%, 3%, 5%, 42%, 44%, 100% {opacity: 1; transform: scaleY(1);}
            4.3% {opacity: 1; transform: scaleY(1.7);}
            43% {opacity: 1; transform: scaleX(1.5);}
        }

        @keyframes noise-3 {
            0%, 3%, 5%, 42%, 44%, 100% {
                opacity: 1;
                transform: scaleY(1);
            }
            4.3% {
                opacity: 1;
                transform: scaleY(4);
            }
            43% {
                opacity: 1;
                transform: scaleX(10) rotate(60deg);
            }
        }
a{
    width: 150px;
text-align: left;
    font-family: 'Gilda Display', serif;
}
        a.animated-button:link, a.animated-button:visited {
            position: relative;
            display: block;
            margin: 30px auto 0;
            padding: 14px 15px;
            color: #fff;
            font-size:14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            letter-spacing: .08em;
            border-radius: 0;
            text-shadow: 0 0 1px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(0, 0, 0, 0.2);
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            transition: all 1s ease;
        }
        a.animated-button:link:after, a.animated-button:visited:after {
            content: "";
            position: absolute;
            height: 0%;
            left: 50%;
            top: 50%;
            width: 150%;
            z-index: -1;
            -webkit-transition: all 0.75s ease 0s;
            -moz-transition: all 0.75s ease 0s;
            -o-transition: all 0.75s ease 0s;
            transition: all 0.75s ease 0s;
        }
        a.animated-button:link:hover, a.animated-button:visited:hover {
            color: black;
            text-shadow: none;
        }
        a.animated-button:link:hover:after, a.animated-button:visited:hover:after {
            height: 450%;
        }
        a.animated-button:link, a.animated-button:visited {
            position: relative;
            display: block;
            margin: 30px auto 0;
            padding: 14px 15px;
            color: #c2c2c2;
            font-size:14px;
            border-radius: 0;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            letter-spacing: .08em;
            text-shadow: 0 0 1px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(0, 0, 0, 0.2);
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            transition: all 1s ease;
        }
        a.animated-button.victoria-two {
            border: 2px solid white;
        }
        a.animated-button.victoria-two:after {
            background: white;
            -moz-transform: translateX(-50%) translateY(-50%) rotate(25deg);
            -ms-transform: translateX(-50%) translateY(-50%) rotate(25deg);
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(25deg);
            transform: translateX(-50%) translateY(-50%) rotate(25deg);
        }
        a.animated-button.victoria-three {
            border: 2px solid white;
        }
        a.animated-button.victoria-three:after {
            background: white;
            opacity: .5;
            -moz-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }




    </style>

    <link rel="shortcut icon" href="{{asset("img/logoJose.png")}}" />
</head>


<body>
<div class="error">404</div>
<br /><br />
<span class="info">Página no encontrada</span>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6"> <a href="{{url('/')}}" class="btn btn-sm animated-button victoria-two">Vuelve al Inicio</a> </div>
    </div>
</div>


</body>
</html>
