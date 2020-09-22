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
    public function getPostsForIndex() : Collection
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
            ->latest()
            ->get();

        return $result;
    }

    //нахуя а главное зачем я это делал?
    /*public function getForEdit(int $id) : Model
    {
        $columns = [
            'id',
            'title',
            'content',
            'created_at',
            'user_id',
            'published_at'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }*/
}
