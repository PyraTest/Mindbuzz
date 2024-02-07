<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GameImage;
use App\Models\GameLetter;
use App\Models\Game;
use App\Models\GameType;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
class GameController extends Controller
{
    use HelpersTrait;
    use backendTraits;

    // Start Game
    public function getGames()
    {
        $games = Game::paginate(10);
        return view('dashboard.games.index', compact(['games']));
    }
    public function getGame($id)
    {
        $game = Game::find($id);
        return view('dashboard.games.show', compact(['game']));
    }

    public function createGame()
    {
        $lessons = Lesson::all();
        $types = GameType::all();

        return view('dashboard.games.create', compact(['lessons', 'types']));
    }

    public function storeGame(Request $request)
    {

        $data = $request->except('_token', 'letter', 'image', 'word');

        $game = Game::create($data);
        $letters = $request->letter;
        $arr = [];
        foreach ($letters as $letter) {
            $i = 0;
            while ($i < $request->num_of_letter_repeat) {
                array_push($arr, [
                    'letter' => $letter, 'index' => $i
                ]);
                $i++;
                $newGameLetter = new GameLetter();
                $newGameLetter->game_id = $game->id;
                $newGameLetter->letter = $letter;
                $newGameLetter->save();
            }
        }
        if (isset($request->image)) {
            foreach ($request->image as $index => $image) {
                $gameImage = new GameImage();
                $gameImage->game_id = $game->id;
                // $gameImage->game_letter_id = $letters->id;
                $gameImage->word = $request->word[$index];
                $gameImage->image = $this->upploadImage($image, 'uploads/games/');
                $gameImage->save();
            }
        }

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }


    // End Game

    
}