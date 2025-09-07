<?php
namespace App\Http\Controllers\Api;

use App\Helpers\HelperFunc;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments with pagination using HelperFunc::paginationNew
     */
    public function index(Request $request)
    {
        $departments    = Department::paginate(10);
        $departmentData = $departments->items();

        // Using paginationNew function from HelperFunc
        $result = HelperFunc::pagination($departmentData, $departments);

        return HelperFunc::sendResponse(200, 'Departments retrieved successfully', $result);
    }
}
