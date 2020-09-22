<?php


namespace App\Repositories;

use App\Models\Post as Model;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Collection
     */
    public function getPostsForIndex()
    {
        $columns = [
            'id',
            'title',
            'content',
            'created_at',
            'user_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->take(20)
            ->get();

        return $result;
    }
}
