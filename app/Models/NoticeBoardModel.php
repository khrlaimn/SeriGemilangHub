<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeBoardModel extends Model
{
    use HasFactory;

    protected $table = 'notice_board';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord(Request $request)
    {
        $query = self::select('notice_board.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'notice_board.created_by');

        if (!empty($request->get('title'))) {
            $query->where('notice_board.title', 'like', '%' . $request->get('title') . '%');
        }

        if ($request->filled('publish_date')) {
            $query->whereDate('notice_board.publish_date', $request->input('publish_date'));
        }
        if (!empty($request->get('message_to')) && $request->get('message_to') != 'all') {
            $query->join('notice_board_message', 'notice_board_message.notice_board_id', '=', 'notice_board.id')
                ->where('notice_board_message.message_to', '=', $request->get('message_to'));
        }
        $return = $query->orderBy('notice_board.id', 'desc')
            ->paginate(5);

        return $return;
    }

    static public function getRecordUser($message_to, $request)
    {
        $return = NoticeBoardModel::select('notice_board.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'notice_board.created_by')
            ->join('notice_board_message', 'notice_board_message.notice_board_id', '=', 'notice_board.id');

        if (!empty($request->get('title'))) {
            $return->where('notice_board.title', 'like', '%' . $request->get('title') . '%');
        }

        if ($request->filled('publish_date')) {
            $return->whereDate('notice_board.publish_date', $request->input('publish_date'));
        }

        $return->where('notice_board_message.message_to', '=', $message_to)
            ->where('notice_board.publish_date', '<=', date('Y-m-d'))
            ->orderBy('notice_board.id', 'desc');

        $paginatedResults = $return->paginate(10);
        return $paginatedResults;
    }


    static public function getRecordUserCount($user_type)
    {
        return NoticeBoardModel::where('notice_board_message.message_to', $user_type)
            ->join('users', 'users.id', '=', 'notice_board.created_by')
            ->join('notice_board_message', 'notice_board_message.notice_board_id', '=', 'notice_board.id')
            ->count();
    }
    public function getMessage()
    {
        return $this->hasMany(NoticeBoardMessageModel::class, "notice_board_id");
    }

    public function getMessageToSingle($notice_board_id, $message_to)
    {
        return NoticeBoardMessageModel::where('notice_board_id', $notice_board_id)
            ->where('message_to', $message_to)
            ->first();
    }
}
