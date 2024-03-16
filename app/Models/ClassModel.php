<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    // Get a single class record by its ID.

    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Get a paginated list of class records based on the provided request criteria.

    static public function getRecord(Request $request)
    {
        $query = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');

        if (!empty($request->get('name'))) {
            $query->where('class.name', 'like', '%' . $request->get('name') . '%');
        }
        if (!empty($request->get('date'))) {
            $query->whereDate('class.created_at', '=', $request->get('date'));
        }

        $result = $query->where('class.is_delete', '=', 0)
            ->orderBy('class.id', 'desc')
            ->paginate(3);

        return $result;
    }
}
