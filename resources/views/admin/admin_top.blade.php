@extends('layouts.admin')

@section('content')

	<div class="card">
		<div class="card-header">Admin TOP</div>
		<div class="card-body">
			<div>
				<a href="{{ url('admin/user_list') }}" class="inline-flex mb-3 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 bg-black">All Users</a>
			</div>

			<div>
				<a href="{{ route('japaneseWord.create') }}" class="inline-flex mb-3 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 bg-black">Add Words</a>
			</div>

			<div>
				<a href="{{ route('admin.wordsPost') }}" class="inline-flex mb-3 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 bg-black">Manage Word post</a>
			</div>
		
			<form method="post" action="{{ url('admin/logout') }}">
				@csrf
				<input type="submit" class="inline-flex mb-3 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 bg-red-500" value="Logout" />
			</form>
		</div>
	</div>

@endsection