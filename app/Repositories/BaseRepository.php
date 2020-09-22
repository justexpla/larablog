<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    /**
     * @return Model
     */
    abstract public function getModel();

    /**
     * @return Model
     */
    public function startConditions()
    {
        return clone $this->model;
    }

    /**
     * Функция-обертка, аналогична Model::get()
     * @return Collection
     */
    public function get()
    {
        $result = $this->startConditions()
            ->get();

        return $result;
    }
}
