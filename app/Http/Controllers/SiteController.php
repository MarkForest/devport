<?php

namespace App\Http\Controllers;

use App\Game;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /*** Стартовый кабинет пользователя ***/
    public function cabinet(Request $request)
    {
        // Информация о пользователе
        $user = Auth::user();

        // Все ссылки этого пользователя
        $links = $user->links;

        // Проверяю не истек ли срок активности ссылки
        foreach ($links as $link) {
            $current = time();
            $life_date = strtotime('+ 7 day', strtotime($link->created_at));
            $diff = intval(date('days', ($life_date - $current)));
            if($diff <= 0) {
                $link->is_active = 0;
                $link->save();
            }
        }

        // Отображаю вид 'cabinet'
        return view('cabinet', [
            'user' => $user,
            'links' => $links,
            'domain' => 'http://'.$request->server('HTTP_HOST'),
        ]);
    }

    /*** Просмотр сгинерированой ссылки ***/
    public function linkShow($link)
    {
        // Получаю ссылку по ее уникальному полю 'link'
        $link = Link::all()->where('link', $link)->first();

        // Проверка на активность ссылки
        if(!$link->is_active) {
            abort(403);
        }

        // Отображаю вид 'game'
        return view('game', [
           'link' => $link,
        ]);
    }

    /*** Метод для гинерации случайного числа,
     * запрос к которому посмупает c помощью Аjax
     ***/
    public function random(Request $request)
    {
        // Гинерирую случайное число
        $random = random_int(Game::MIN, Game::MAX);

        // Расчет процентного соотношения суммы выиграша
        $amount = Game::calculate($random);

        // Добавляю новый результат в бд
        $game = Game::add([
            'random' => $random,
            'link_id' => $request->link_id,
        ]);

        // Возвращаю результат в формате Json
        echo json_encode(['random' => $game->random, 'amount' => $amount]);
    }

    /*** Метод для возврата 3 последних результатов,
     * запрос к которому посмупает c помощью Аjax
     ***/
    public function history(Request $request)
    {
        $response = [];

        // Получаю 3-и последних резултата
        $games = DB::table('games')
            ->where('link_id', $request->link_id)
            ->orderBy('created_at', 'desc')
            ->take(3)->get();

        // Формирую массив с рандомным значением каждого резултата,
        // плюс просчитываю сумму выиграша
        $index = 0;
        foreach ($games as $game) {
            $response[$index]['random'] = $game->random;
            $response[$index]['amount'] = Game::calculate($game->random);
            $index++;
        }

        // Возвращаю результат в формате Json
        echo json_encode($response);
    }

    /***
     * Метод для создании новой ссылки
     * для аутентифицированого пользователя
     ***/
    public function linkNew(Request $request)
    {
        // Добавляю в базу новую ссылку
        Link::add([
            'link' => time(),
            'user_id' => Auth::user()->id,
            'is_active' => Link::ACTIVE_MODE
        ]);

        // Отображаю стартовый вид кабинета
        return redirect('/cabinet');
    }

    // Метод для деактивации текущей ссылки
    public function deactivate(Request $request)
    {
        // Получаю ссылку меняю значение поля 'is_active'
        $link = Link::find($request->link_id);
        $link->is_active = 0;
        $link->save();

        // Отображаю стартовый вид кабинета
        return redirect('/cabinet');
    }
}
