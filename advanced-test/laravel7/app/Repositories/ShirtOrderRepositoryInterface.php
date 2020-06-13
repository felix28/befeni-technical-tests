<?php 
namespace App\Repositories;

interface ShirtOrderRepositoryInterface 
{
	public function create(array $data);

    public function find(int $id);

    public function delete(int $id);

    public function paginate(int $rowsPerPage);
}
?>