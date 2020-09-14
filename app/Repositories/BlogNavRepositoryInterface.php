<?php

/**
 * Created by PhpStorm.
 * User: liuxiang
 */
namespace app\Repositories;
 
interface  BlogNavRepositoryInterface
{
    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'));
 
    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = array('*'));
 
    /**
     * Create a new Blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function create(array $data);
 
    /**
     * Update a Blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function update($data = [], $id);
 
    /**
     * Store a Blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function store($data = []);
 
    /**
     * Delete a Blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function delete($data = [], $id);
 
    /**
     * @param $id
     * @param array $columns
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find($id, $columns = array('*'));
 
    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findBy($field, $value, $columns = array('*'));
}
