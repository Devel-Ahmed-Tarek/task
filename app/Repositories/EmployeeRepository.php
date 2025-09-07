<?php
namespace App\Repositories;

use App\Contracts\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(): Collection
    {
        return Employee::with('department')->get();
    }

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Employee::with('department')->paginate($perPage);
    }

    public function findById(int $id): ?Employee
    {
        return Employee::with('department')->find($id);
    }

    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(Employee $employee, array $data): Employee
    {
        $employee->update($data);
        return $employee->fresh(['department']);
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }

    public function search(string $query): Collection
    {
        return Employee::with('department')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->get();
    }

    public function filterByDepartment(int $departmentId): Collection
    {
        return Employee::with('department')
            ->where('department_id', $departmentId)
            ->get();
    }

    public function getWithFilters(array $filters): Collection
    {
        $query = Employee::with('department');

        if (isset($filters['department_id']) && $filters['department_id']) {
            $query->where('department_id', $filters['department_id']);
        }

        if (isset($filters['search']) && $filters['search']) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }
}
