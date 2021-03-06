@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('admin/user_list') }}">All Users</a> &gt; User details
		</div>
		<div class="card-body">
			<div class="my-3">
				@include('components.session')
				</div>
			<ul class="list-group">
				<li class="list-group-item">ID: {{ $user->id }}</li>
				<li class="list-group-item">名前: {{ $user->name }}</li>
				<li class="list-group-item">メール: {{ $user->email }}</li>
				<li class="list-group-item">作成日: {{ $user->created_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item mb-5">更新日: {{ $user->updated_at->format('Y/m/d H:i:s') }}</li>
			</ul>
				
        @foreach ($languages as  $language)
        <div class="p-2 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
                     
        <p class="question focus:outline-none">{{ $language->japanese }} 
        
         <a href={{ route('admin.edit',$language->id) }}> <i class="ml-2 far fa-edit"></i></a>     
       </p>
          <p class="english mt-2 ml-6 text-red-500" >{{ $language->english }}
           </p> 
        </div>
        @endforeach
				<div class="my-5">
				{{ $languages->links()  }}
			 </div>
        
				<h2 class="mb-3 text-2xl">Favorites</h2>
				@foreach ($favorites as $favorite)
				<div class="p-2 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
				<p class="question focus:outline-none">{{ $favorite->japanese }} 
					<a href={{ route('admin.edit',$favorite->id) }}> <i class="ml-2 far fa-edit"></i></a>     
				</p>
					 <p class="english mt-2 ml-6 text-red-500" >{{ $favorite->english }}</p> 
					 <p class="english mt-2 ml-6 " >{{ $favorite->getOriginal()['pivot_created_at'] }}</p> 
						
					</div>
				@endforeach
		    <div class="mt-2">
				{{ $favorites->links()  }}
			 </div>
		</div>
	</div>
</div>
@endsection