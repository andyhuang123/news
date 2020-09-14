<?php
/**
 * Created by PhpStorm.
 * User: liuxiang
 */
namespace app\Repositories\Eloquent;
 
use App\Models\BlogNavArticle;
use app\Repositories\BlogNavRepositoryInterface;
 
class BlogNavRepository implements BlogNavRepositoryInterface
{
    /**
     * @var \App\Blognav
     */
    public $blognav;
 
    public function __construct(BlogNavArticle $blognav)
    {
        $this->blognav = $blognav;
    }
 
    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'))
    {
        return $this->blognav->all($columns);
    }
 
    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->blognav->orderBy('id','desc')->paginate($perPage, $columns);
    }
 
    /**
     * Create a new blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function create(array $data)
    {
        return $this->blognav->create($data);
    }
 
     /**
       * Update a blognav
       * @param array $data
       * @param $id
       * @return \App\Blognav
       */
    public function update($data = [], $id)
    {
        return $this->blognav->whereId($id)->update($data);
    }
 
    /**
     * Store a blognav
     * @param array $data
     * @return \App\Blognav
     */
    public function store($data = [])
    {
        $this->blognav->id = $data['id'];
        //...
        $this->blognav->save();
    }
 
    /**
     * Delete a blognav
     * @param array $data
     * @param $id
     * @return \App\Blognav
     */
    public function delete($data = [], $id)
    {
        $this->blognav->whereId($id)->delete();
    }
 
    /**
     * @param $id
     * @param array $columns
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find($id, $columns = array('*'))
    {
        $Blognav = $this->blognav->whereId($id)->get($columns);
        return $Blognav;
    }
 
    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findBy($field, $value, $columns = array('*'))
    {
        $Blognav = $this->blognav->where($field, '=', $value)->get($columns);
        return $Blognav;
    }
 
}