@extends('layouts.default')

@section('content')

<div class="w-full mb-10 ">

  @include('nav')

  @if (session('status'))
  <div class="ml-5 text-green-500 text-2xl font-bold" role="alert">
  {{ session('status') }}
  </div>
  @endif

  
  <h1 class="font-sans font-bold break-normal text-gray-700 px-2 text-2xl mt-5  md:text-2xl">
  5秒英作文<i class="fas fa-paw ml-1"></i>
  </h1>
  <hr class="bg-gray-300 my-12">
 
  <h2 id='section1' class=" font-sans font-bold break-normal text-gray-700 px-2 pb-3 text-xl">
  English→Japanese <i class="far fa-cat"></i></h2>

  <div class="ml-5 mt-3 ">
    <p class=" pb-1">Read the English sentence and guess how to say it in Japanese in <span class="text-red-500">5</span> seconds.
    <br> If you have no idea, click on the English sentence. 
    <br> Then, Japanese will be displayed.
    <i class="far fa-laugh-wink"></i>

    </p>

    <p class="text-blue-700 mt-1">
    <a href="/">
    <br>日本語→英語 (Japanese→English)Ver. </a> </p>
    </div>


    <div class="mt-4">
    @foreach ($languages as  $language)
    <div class="p-5 mt-6 lg:mt-2 leading-normal rounded shadow bg-white">
    {{-- ログイン時 favorite-button--}}
    @auth
    <favorite-button
    :language={{ $language->id }}
    :favorited={{ $language->favorited() ? 'true' : 'false' }}
    >  </favorite-button
    >
    @endauth
    {{-- end ログイン時 --}} 
    <button class="question focus:outline-none">{{ $language->english }}

    {{--edit  --}}
    @if($user == $language->user)
    <a href={{ route('edit',$language->id) }}> <i class="ml-2 far fa-edit"></i></a>     
    @endif
    {{--edit  --}}
    </button>
    <p class="english mt-2 ml-6 text-red-500 font-bold" >{{ $language->japanese }}
    </p> 
            
    </div>
    @endforeach
    </div>
</div >
@endsection