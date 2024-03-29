<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Language;
use App\Models\Favorite;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function showLoginForm(Request $request)
		{
			 
		if($request->session()->has('admin_auth')){
			// $request->session()->put("admin_auth", true);
			return redirect("admin/show");
		}
		return view("admin.admin_login");
  	}

	
	function login(Request $request)
	 {
		//入力内容をチェックする
		$user_id = $request->input("user_id");
		$password = $request->input("password");

		//ログイン成功
		if($user_id == "admin" && $password == "adminad"){
			$request->session()->put("admin_auth", true);
			return redirect("admin/show");
		}
  

		//ログイン失敗
		return redirect("admin/login")->withErrors([
			"login" => "ユーザーIDまたはパスワードが違います"
		]);
	}

    function logout(Request $request){
		$request->session()->forget("admin_auth");
		return redirect("admin/login");
	}

	public function index()
	{

			$languages = Language::with('user')->inRandomOrder()->take(30)->get();
			return view('admin.index', [
					'languages' => $languages,

			]);
	}
	
    function show(){
		return view("admin.admin_top");
	}

    function showUserList(){
		$user_list = User::orderBy("id", "desc")->paginate(25);
		return view("admin.user_list", [
			"user_list" => $user_list
		]);
	}

	function showUserDetail($id){
		$user = User::find($id);
		//Userの投稿
		$languages = Language::where('user_id',$user->id )->paginate(20);
   //UserのFavorites
		$favorites = $user->favorites()->orderBy('pivot_created_at','desc')->take(30)->paginate();


	// dd($favorites );
		return view("admin.user_detail", [
			"user" => $user,
			'languages' => $languages,
			'favorites' => $favorites,
		]);
	}

	    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
        public function edit($id)
        {
            $language = Language::find($id);

            // dd($language);
            return view('admin.edit',[
                'language' => $language
            ]);
        }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request,$id)
    {
        $language = Language::find($id);
				$user = $language->user;

        $input = $request->only('japanese','english');

        $validator = Validator::make($input, [
            'english' => 'required',
            'japanese' => 'required',
      
		]);

        //バリデーション失敗
		if($validator->fails()){
			return back()
				->withErrors($validator)
				->withInput();
		}

        	//バリデーション成功
		$language->japanese = $input["japanese"];
		$language->english = $input["english"];
		
		$language->save();

        return redirect('admin/user/'. $user->id)->withStatus("訂正完了！");
    }

		public function adminSearch(Request $request) 
		{
			$query = $request->input('query');

			if(!$query) {
					return back();
			}
		 $languages = Language::where('english', 'LIKE',"%{$query}%")
		 ->orWhere('japanese', 'LIKE',"%{$query}%")
		 ->orWhere('id', 'LIKE',"%{$query}%")
		 ->simplePaginate(20);
	
	//    dd($languages);
		 return view('admin.search_results',[
				 'languages' => $languages
		 ]);
 		}

		 
}
