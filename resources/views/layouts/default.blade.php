<!DOCTYPE html>
<html lang="ja" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>5秒英作文 ～5seconds English～ 日本語を見て5秒で英文を作ろう</title>
    <meta property="og:site_name" content="5秒英作文 ～5seconds English～" />
    <meta property="og:title" content="5秒英作文 ～5seconds English～"/>
    <meta name="keywords" content="瞬間英作文,スピーキング,英語,5秒英作文,TOEIC,英会話,英語学習">
    <meta name="description" content="5秒英作文。日本語を見て5秒以内に英語を声に出します。基本的な文法を使って、比較的短い日本語を5秒で英作文するトレーニングを進めていきます。短時間でもいいので、毎日繰り返し練習して英語になれましょう。">
    <meta property="st:section" content="5秒英作文。日本語を見て5秒以内に英語を声に出します。基本的な文法を使って、比較的短い日本語を5秒で英作文するトレーニングを進めていきます。短時間でもいいので、毎日繰り返し練習して英語になれましょう。"/>
    <meta name="twitter:title" content="5秒英作文 ～5seconds English～"/>
    <meta property="og:url" content="https://5seconds-en.com/" />
    <meta property="og:image" content="https://image.freepik.com/free-photo/top-view-decoration-with-cubes-wooden-background_23-2148389005.jpg" />
    {{-- Twitter --}}
    <meta name="twitter:card" content="Summary">
    <meta name="twitter:title" content="5秒英作文 ～5seconds English～">
    <meta name="twitter:description" content="5秒英作文。日本語を見て5秒以内に英語を声に出します。基本的な文法を使って、比較的短い日本語を5秒で英作文するトレーニングを進めていきます。短時間でもいいので、毎日繰り返し練習して英語になれましょう。">
    <meta name="twitter:image" content="https://image.freepik.com/free-photo/top-view-decoration-with-cubes-wooden-background_23-2148389005.jpg" >

    {{-- Search Console --}}
    <meta name="google-site-verification" content="Xja4SEPoY8ersK2goh_5cGHoLdvCDalwlmQLTV1F-io" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BT31K5VNL5"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-BT31K5VNL5');
    </script>

    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Stick&display=swap" rel="stylesheet">
 
  {{-- fontawesome --}}
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="bg-gray-100 text-gray-900 tracking-wider  ">
  <div id="app">
 
  @yield('content')
  
</div>

<script>
  $(document).ready(function(){
  $(".question").on("click", function() {
  $(this).next().slideToggle(200);
  });
  });


  $(document).ready(function(){
        // window.utterances = [];

        // var click_count = 0;
        $('.trigger').on('click', function(event){

            var trigger = $(this);
            var parent = $(this).parents('li');
            var answer = $('.answer', parent);
            var message = $(answer).val();
            // message = replaceMessage(message);
         
            var speech = new SpeechSynthesisUtterance();

            speech.volume = 1.0;
            speech.rate = 1.0;
            speech.pitch = 1.0;
            speech.text = message;
            speech.lang = 'en-US';


            // utterances.push(speech);

            speechSynthesis.speak(speech);
         
            // console.log( speechSynthesis.speak(speech));
            // console.log( speech);
        });
    });
    
//]]>
</script><script type="text/javascript">
//<![CDATA[

/**
  * replace message
  *
  * @param Str
  * @return Str
  */
function replaceMessage(mes) {

    var target;
    var list = [
        '\\(1\\)',
        '\\(2\\)',
        '\\(3\\)',
        '\\( 1 \\)',
        '\\( 2 \\)',
        '\\( 3 \\)',
        '_',
        '\/',
        '（1）',
        '（2）',
        '（3）',
        '（ 1 ）',
        '（ 2 ）',
        '（ 3 ）',
        '[^\x01-\x7E]',
    ];

    $.each(list, function(i, val) {

        target = new RegExp(val, "g");
        if (mes.match(target)) {
            mes = mes.replace(target, ' ');
        }
    });

    return mes;
   
}


</script>

<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>