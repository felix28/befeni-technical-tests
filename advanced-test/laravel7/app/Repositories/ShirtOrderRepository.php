<?php 
namespace App\Repositories;

use App\ShirtOrder;

class ShirtOrderRepository implements ShirtOrderRepositoryInterface
{
    protected $model;

    public function __construct(ShirtOrder $model)
    {
        $this->model = $model;
    }

	public function create(array $data)
	{
        return $this->model->create($data);
	}

    public function find(int $id)
    {
        return $this->model->find($id);   
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function paginate(int $rowsPerPage)
    {
        return $this->model->paginate($rowsPerPage);   
    }
}
?>