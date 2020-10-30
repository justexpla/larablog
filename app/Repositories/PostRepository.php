<?php


namespace App\Repositories;

use App\Models\Post as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PostRepository extends BaseRepository
{
    /**
     * Функция для удобства копипаста - меняем только в use
     * @return Model
     */
    public function getModel()
    {
        return Model::class;
    }

    /**
     * Получение постов для индексной страницы
     * @param array $attributes
     * @param bool $showBlacklisted
     * @return Collection
     */
    public function getPosts(array $attributes = [], bool $showBlacklisted = true)
    {
        //TODO: явно нужен будет рефактор. Возможно разбить на 2 метода - с блеклистом и без него
        if($showBlacklisted && auth()->check()) {
            $blackListedUsers = auth()->user()->blackList->pluck('id')->toArray();
        }

        $count = config('settings.index_post_count');

        $columns = [
            'id',
            'title',
            'content',
            'created_at',
            'user_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->where($attributes);

        if(isset($blackListedUsers) && count($blackListedUsers)) {
            $result = $result->whereNotIn('user_id', $blackListedUsers);
        }

        $result = $result->latest()
            ->paginate($count);

        $result->load('user', 'commentaries')
            ->transform(function ($item) {
                return $this->limitContentLength($item);
            });

        return $result;
    }

    public function limitContentLength($item, $symbolLimit = null)
    {
        if (!$symbolLimit) {
            $symbolLimit = config('settings.index_post_chars_limit');
        }

        if (mb_strlen($item->content) > $symbolLimit) {
            $item->content = Str::limit($item->content, $symbolLimit, '...');
            $item->is_chopped = true;
        }
        return $item;
    }
}
