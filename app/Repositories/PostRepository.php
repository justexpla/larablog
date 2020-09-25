<?php


namespace App\Repositories;

use App\Models\Post;
use App\Models\Post as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            ->latest()
            ->take(config('settings.index_post_count'))
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

    public function getPostsByUser(int $id)
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
            ->where('user_id', $id)
            ->latest()
            ->take(config('settings.index_post_count'))
            ->get();

        return $result;
    }

    public function getMorePostsForIndex(int $offset)
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
            ->latest()
            ->offset($offset)
            ->take(config('settings.index_post_count'))
            ->get();

        return $result;
    }

    public function getMorePostsForUser(int $userId, int $offset)
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
            ->where('user_id', $userId)
            ->latest()
            ->offset($offset)
            ->take(config('settings.index_post_count'))
            ->get();

        return $result;
    }
}
