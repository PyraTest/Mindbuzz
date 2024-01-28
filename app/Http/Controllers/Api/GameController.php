<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameLetter;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class GameController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    public function getGamesByType($id){
        $data['games'] = Game::join('game_types','games.game_type_id','game_types.id')->where('game_types.id',$id)->get();
        return $this->returnData('data', $data);
    }
    public function indexGame($id){
        $game_test = Game::where('id',$id)->first();
        $game = Game::where('id',$id);
        switch ($game_test->game_type_id == 1){
            case 1:
                $game->with(['gameLetters' => function($q) {
                    $q->inRandomOrder();
                }]);
                $data['game_letters'] = GameLetter::where('game_id',$id)->select('letter')->groupBy('letter')->inRandomOrder()->get();
                break;
            }
            $data['game'] = $game->first();
        return $this->returnData('data', $data);

    }
    public function attempt(Request $request){
        $validate = Validator::make($request->all(), [
            'letter' => 'required',
            'dropped_into' => 'required',
        ]);

        if ($validate->fails()) {
            $code = $this->returnCodeAccordingToInput($validate);
            return $this->returnValidationError($code, $validate);
        }
        if($request->letter == $request->dropped_into){
            return $this->returnSuccessMessage('Correct');
        }
        else
        return $this->returnError('401', 'Incorrect') ;
    }
}
