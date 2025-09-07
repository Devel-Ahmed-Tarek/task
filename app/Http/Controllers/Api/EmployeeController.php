<?php
namespace App\Http\Controllers\Api;

use App\Contracts\EmployeeServiceInterface;
use App\Contracts\LoggingServiceInterface;
use App\Helpers\HelperFunc;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEmployeeRequest;
use App\Http\Requests\Api\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeServiceInterface $employeeService,
        private LoggingServiceInterface $loggingService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees         = $this->employeeService->getPaginatedEmployees($request);
        $employeeResources = EmployeeResource::collection($employees);

        return HelperFunc::pagination($employees, $employeeResources);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee($request->validated());

        $this->loggingService->logApiOperation('created', $employee->toArray());

        return HelperFunc::sendResponse(201, 'Employee created successfully', new EmployeeResource($employee->load('department')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = $this->employeeService->getEmployeeById($employee->id);
        return HelperFunc::sendResponse(200, 'Employee data retrieved successfully', new EmployeeResource($employee->load('department')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $updatedEmployee = $this->employeeService->updateEmployee($employee, $request->validated());

        $this->loggingService->logApiOperation('updated', $updatedEmployee->toArray());

        return HelperFunc::sendResponse(200, 'Employee updated successfully', new EmployeeResource($updatedEmployee->load('department')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employeeData = $employee->toArray();
        $this->employeeService->deleteEmployee($employee);

        $this->loggingService->logApiOperation('deleted', $employeeData);

        return HelperFunc::sendResponse(200, 'Employee deleted successfully', []);
    }
}
