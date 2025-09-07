<?php
namespace App\Contracts;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function getAll(): Collection;
    public function getPaginated(int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): ?Employee;
    public function create(array $data): Employee;
    public function update(Employee $employee, array $data): Employee;
    public function delete(Employee $employee): bool;
    public function search(string $query): Collection;
    public function filterByDepartment(int $departmentId): Collection;
    public function getWithFilters(array $filters): Collection;
}
