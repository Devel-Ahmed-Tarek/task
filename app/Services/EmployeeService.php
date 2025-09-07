<?php
namespace App\Services;

use App\Contracts\EmployeeRepositoryInterface;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\LoggingServiceInterface;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class EmployeeService implements EmployeeServiceInterface
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private LoggingServiceInterface $loggingService
    ) {}

    public function getAllEmployees(): array
    {
        $employees = $this->employeeRepository->getAll();
        return $employees->toArray();
    }

    public function getPaginatedEmployees(Request $request): LengthAwarePaginator
    {
        $query = Employee::with('department');

        // Apply filters
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->paginate(10);
    }

    public function getEmployeeById(int $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    public function createEmployee(array $data): Employee
    {
        $employee = $this->employeeRepository->create($data);
        $this->loggingService->logEmployeeCreated($employee);
        return $employee;
    }

    public function updateEmployee(Employee $employee, array $data): Employee
    {
        $oldData         = $employee->toArray();
        $updatedEmployee = $this->employeeRepository->update($employee, $data);
        $this->loggingService->logEmployeeUpdated($updatedEmployee, $oldData);
        return $updatedEmployee;
    }

    public function deleteEmployee(Employee $employee): bool
    {
        $employeeData = $employee->toArray();
        $result       = $this->employeeRepository->delete($employee);
        $this->loggingService->logEmployeeDeleted($employeeData);
        return $result;
    }

    public function searchEmployees(string $query): array
    {
        $employees = $this->employeeRepository->search($query);
        return $employees->toArray();
    }

    public function filterEmployeesByDepartment(int $departmentId): array
    {
        $employees = $this->employeeRepository->filterByDepartment($departmentId);
        return $employees->toArray();
    }

    public function getEmployeesWithFilters(Request $request): array
    {
        $filters   = $request->only(['department_id', 'search']);
        $employees = $this->employeeRepository->getWithFilters($filters);
        return $employees->toArray();
    }
}
