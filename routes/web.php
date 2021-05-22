<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Recipee;
use App\Ingredient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use App\IngredientsAllowed;

Route::group(['middleware' => ['web']], function () {
    /**
     * GET Routes
     */
    Route::get('/', function (Request $request) {
        $str = preg_replace("/[^A-Za-z0-9 ]/u", "", $request->term);
        if($str != '') {
            $recipees = Recipee::search($str)->select(['id'])->from(0)->take(10)->get();
        } else {
            $recipees = Recipee::search('*')->select(['id'])->from(0)->take(10)->get();
        }

        $recipeelist = array();

        foreach($recipees as $recipee) {
            $recipeeres = Recipee::find($recipee->id);
            array_push($recipeelist, $recipeeres);
        }

        return view('index', [
            "recipees" => $recipeelist
        ]);
    });

    Route::get('/recipees/view/{id}', function ($id) {
        $recipee = Recipee::find($id);
        
        foreach($recipee['ingredients'] as $ing) {
            Redis::command('incr', ['ingr:' . str_replace(' ', '', preg_replace("/(?![.=$'€%-])\p{P}/u", "", strtolower($ing->name))), 1]);
        }

        return view('recipee', [
            'recipee' => $recipee
        ]);
    });

    Route::get('/recipees/add', function () {
        return view('add');
    });

    Route::get('/recipees/edit/{id}', function ($id) {
        $recipee = Recipee::find($id);

        return view('edit', [
            'recipee' => $recipee
        ]);
    });

    Route::get('/metrics', function () {
        $keyvalueingr = array();
        $keyarringr = array();
        $keyvaluereq = array();
        $keyarrreq = array();

        $redis = Redis::connection();
        $keys = IngredientsAllowed::$types;

        foreach($keys as $k) {
            $val = $redis->get('ingr:' . $k) . '.0';
            array_push($keyvalueingr, $val);
            array_push($keyarringr, $k);
        }

        foreach(Redis::command('keys', ['visits:*']) as $k) {
            $val = $redis->get(explode('_', $k)[2]) . '.0';
            array_push($keyvaluereq, $val);
            array_push($keyarrreq, explode('_', $k)[2]);
        }

        $res = str_replace("\r","\n", view('stats', [
            'keyingr' => $keyarringr,
            'valuesingr' => $keyvalueingr,
            'keyreq' => $keyarrreq,
            'valuesreq' => $keyvaluereq
        ])->render());

        return response($res)->withHeaders([
            'Content-Type' => 'text/plain; version=0.0.4'
        ]);
    });

    /**
     * POST Routes
     */
    Route::post('/recipees/add', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:1000',
            'description' => 'required|max:10000', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/recipees/add')
                ->withInput()
                ->withErrors($validator);
        }

        $recipee = new Recipee;
        $recipee->name = $request['name'];
        $recipee->description = $request['description'];

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $recipee->imagepath = $imageName;
        $ingredientsstr = "";

        $ingredientsarr = array();

        $i = 0;
        foreach($request['ingredients'] as $ing) {
            $ing["transformed"] = str_replace(' ', '', preg_replace("/(?![.=$'€%-])\p{P}/u", "", strtolower($ing["name"])));

            $validator = Validator::make($ing, [
                'name' => 'required|string',
                'amount' => 'required|numeric',
                'transformed' => Rule::in(IngredientsAllowed::$types),
            ]);

            if ($validator->fails()) {
                return redirect('/recipees/add')
                    ->withInput()
                    ->withErrors($validator);
            }

            $ingredient = new Ingredient;

            $ingredient->name = $ing["name"];
            $ingredient->amount = $ing["amount"];

            $ingredientsstr = $ingredientsstr . ";" . $ing["name"];

            array_push($ingredientsarr, $ingredient);
            $i += 1;
        }

        $recipee->ingredientsstr = $ingredientsstr;
        $recipee->save();
        $recipee = $recipee->ingredients()->saveMany($ingredientsarr);
        
        return redirect('/');
    });

    Route::post('/recipees/edit/{id}', function (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:1000',
            'description' => 'required|max:10000', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/recipees/edit/' . $id)
                ->withInput()
                ->withErrors($validator);
        }

        $recipee = new Recipee;
        $recipee->name = $request['name'];
        $recipee->description = $request['description'];

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $recipee->imagepath = $imageName;
        $ingredientsstr = "";

        $ingredientsarr = array();

        $i = 0;
        foreach($request['ingredients'] as $ing) {
            $ing["transformed"] = str_replace(' ', '', preg_replace("/(?![.=$'€%-])\p{P}/u", "", strtolower($ing["name"])));
            $validator = Validator::make($ing, [
                'name' => 'required|string',
                'amount' => 'required|numeric',
                'transformed' => Rule::in(IngredientsAllowed::$types),
            ]);

            if ($validator->fails()) {
                return redirect('/recipees/add')
                    ->withInput()
                    ->withErrors($validator);
            }

            $ingredient = new Ingredient;

            $ingredient->name = $ing["name"];
            $ingredient->amount = $ing["amount"];

            $ingredientsstr = $ingredientsstr . ";" . $ing["name"];

            array_push($ingredientsarr, $ingredient);
            $i += 1;
        }

        $recipee->ingredientsstr = $ingredientsstr;
        $recipee->save();
        $recipee = $recipee->ingredients()->saveMany($ingredientsarr);
        
        return redirect('/');
    });

    Route::post('/recipees/delete/{id}', function (Request $request, $id) {

        $recipee = Recipee::find($id);
        if(File::exists(public_path('images/' . $recipee->imagepath))){
            File::delete(public_path('images/' . $recipee->imagepath));
        }
        $recipee->delete();
        
        return redirect('/');
    });
});